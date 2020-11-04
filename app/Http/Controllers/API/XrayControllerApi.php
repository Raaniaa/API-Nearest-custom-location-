<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Xray;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class XrayControllerApi extends Controller
{
    public function getAllXray(){
        $xrays = Xray::count();
        if ($xrays){
            $xray = Xray::paginate(20);
            return response([
                'data' => $xray ,
                'message' => 'success'], 200);
            }else{
                return response(['message' => 'failed']);
            }
    }
    public function index(Request $request)
    {
        $xrays = $this->getNearby($request);
        if ($xrays){
            return response([
                'data' => $xrays ,
                'message' => 'success'], 200);
            }else{
                return response(['message' => 'failed']);
            }
        
    }


    /**
     * Return nearby pharmacies
     * @param $request
     * @return array
     */
    private function getNearby($request)
    {
        $latitudeTo = $request->latitude;
        $longitudeTo = $request->longitude;
        $earthRadius = 6378137; // earth radius it's fixed value 6378137

        $nearbyXrays = [];

        $xrays = Xray::where('name', 'LIKE', $request->name.'%')->paginate(20);

        foreach ($xrays as $xray) {
            $latitudeFrom = $xray->latitude;
            $longitudeFrom = $xray->longitude;

            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            $distance = round($angle * $earthRadius);
//            $distance = $distance >= 1000 ? (round($distance/1000, 2)) : $distance;
            $xray->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyXrays, $xray);
        }

        if (count($nearbyXrays)) {
            return $nearbyXrays;
        }
    }

    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'address'=>'required',
            'phone'=>'required',
            'photo'=> '',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        
        $xrays = Xray::create($data);
    
        return response([
            'data' => $xrays,
            'message' => 'Created successfully'], 200);
    }
    
    public function show(Request $request){
        $name_search = Xray::where('name','like','%' . $request->name . '%')->paginate(20);
        return response()->json([
            'data'  => $name_search,
            'status'=> true
        ]);
    }
    

}
