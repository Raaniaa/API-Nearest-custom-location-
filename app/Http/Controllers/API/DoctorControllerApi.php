<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialty;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DoctorControllerApi extends Controller
{
    public function getAllDoctor(){
        $doctors = Doctor::get();
        return response()->json([
                'data'  => $doctors,
            ]);
    }
    public function index(Request $request)
    {
        $doctors = $this->getNearby($request);
        return response([
            'data' => $doctors ,
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
        $specialty = $request->specialtyName;
        $earthRadius = 6378137; // earth radius it's fixed value 6378137

        $nearbyDoctors = [];

        $doctors = Doctor::where('name', 'LIKE', "%$request->name%")->get();

        foreach ($doctors as $doctor) {
            $latitudeFrom = $doctor->latitude;
            $longitudeFrom = $doctor->longitude;

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
            $doctor->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyDoctors, $doctor);
        }

        if (count($nearbyDoctors)) {
            return $nearbyDoctors;
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
            'specialtyName'=>'required',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        
        $doctors = Doctor::create($data);
    
        return response([
            'data' => $doctors,
            'message' => 'Created successfully'], 200);
    }
    
    public function show(Request $request){
        $name_search = Doctor::where('name','like','%' . $request->name . '%')->get();
        return response()->json([
            'data'  => $name_search,
            'status'=> true
        ]);
    }
    

}
