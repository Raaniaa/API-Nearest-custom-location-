<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Labs;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class LabControllerApi extends Controller
{
    public function getAllLab(){
        $labs = Labs::get();
        return response()->json([
                'data'  => $labs,
            ]);
    }
    public function index(Request $request)
    {
        $labs = $this->getNearby($request);
        return response([
            'labs' => $labs ,
            'message' => 'Retrieved successfully'], 200);
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

        $nearbyLabs = [];

        $labs = Labs::where('LabName', 'LIKE', "%$request->name%")->get();

        foreach ($labs as $lab) {
            $latitudeFrom = $lab->latitude;
            $longitudeFrom = $lab->longitude;

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
            $lab->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyLabs, $lab);
        }

        if (count($nearbyLabs)) {
            return $nearbyLabs;
        }
    }

    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'LabName' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'address'=>'required',
            'phone'=>'required',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        
        $labs = Labs::create($data);
    
        return response([
            'labs' => $labs,
            'message' => 'Created successfully'], 200);
    }
    
    public function show(Request $request){
        $name_search = Labs::where('LabName','like','%' . $request->name . '%')->get();
        return response()->json([
            'data'  => $name_search,
            'status'=> true
        ]);
    }
    

}