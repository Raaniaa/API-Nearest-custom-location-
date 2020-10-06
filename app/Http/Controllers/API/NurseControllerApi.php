<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Nurse;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class NurseControllerApi extends Controller
{
    public function getAllNurse(){
        $nurses = Nurse::get();
        return response()->json([
                'data'  => $nurses,
            ]);
    }
    public function index(Request $request)
    {
        $nurses = $this->getNearby($request);
        return response([
            'nurses' => $nurses ,
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

        $nearbyNurses = [];

        $nurses = Nurse::where('NurseName', 'LIKE', "%$request->name%")->get();

        foreach ($nurses as $nurse) {
            $latitudeFrom = $nurse->latitude;
            $longitudeFrom = $nurse->longitude;

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
            $nurse->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyNurses, $nurse);
        }

        if (count($nearbyNurses)) {
            return $nearbyNurses;
        }
    }

    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'NurseName' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'address'=>'required',
            'gender'=>'max:20',
            'phote'=>'',
            'phone'=>'required|max:255',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        
        $nurses = Nurse::create($data);
    
        return response([
            'nurses' => $nurses,
            'message' => 'Created successfully'], 200);
    }
    
    public function show(Request $request){
        $name_search = Nurse::where('NurseName','like','%' . $request->name . '%')->get();
        return response()->json([
            'data'  => $name_search,
            'status'=> true
        ]);
    }
    

}