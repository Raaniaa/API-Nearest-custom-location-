<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\Doctor;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SpecialtyControllerApi extends Controller
{ 
     public function getAllSpecialty(){
    $specialties = Specialty::count();
    if ($specialties){
        $specialty = Specialty::paginate(20);
        return response([
            'data' => $specialty ,
            'message' => 'success'], 200);
        }else{
            return response(['message' => 'failed']);
        }
}
    public function index(Request $request)
    {
        $specialties = $this->getNearby($request);
        if ($specialties){
            return response([
                'data' => $specialties ,
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

        $nearbySpecialties = [];

        $specialties = Doctor::where('specialtyName', 'LIKE', "%$request->name%")->get();
        
        foreach ($specialties as $specialty) {
            $latitudeFrom = $specialty->latitude;
            $longitudeFrom = $specialty->longitude;

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
            $specialty->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbySpecialties, $specialty);
        }

        if (count($nearbySpecialties)) {
            return $nearbySpecialties;
        }
    }

    


    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'specialtyName' => 'required|max:255',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
       
        $specialties = Specialty::create($data);
        return response([
            'data' => $specialties,
            'message' => 'Created successfully'], 200);
    }

    public function show(Request $request){
        $name_search = Doctor::where('specialtyName','like','%' . $request->name . '%')->get();
        return response()->json([
            'data'  => $name_search,
            'status'=> true
        ]);
    }
}
