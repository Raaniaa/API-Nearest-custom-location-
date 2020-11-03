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
        
        $doctors = Doctor::paginate(20);
        //dd($doctors);
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

        $doctors = Doctor::where('name', 'LIKE', $request->name.'%')->paginate(20);

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
            'telephone'=>'required',
            'fees'=>'required',
            'duration'=>'',
            'specialtyName'=>'required',
            'photo'=> '',
            'days'=>'required|array',
            'hours'=>'required|array',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
     //   $workTime = ['days' => $request->days, 'hours' => $request->hours];
     $days=$request->days;
     $hours=$request->hours;
     $data['days']=json_encode($days);
     $data['hours']=json_encode($hours);
	//	$data['work_times'] = json_encode($workTime);
        
        $doctors = Doctor::create($data);
	    //$doctors['work_times'] = json_decode($doctors->work_times);
        $doctors['days'] = json_decode($doctors->days);
        $doctors['hours'] = json_decode($doctors->hours);
    
        return response([
            'data' => $doctors,
            'message' => 'Created successfully'], 200);
    }
    
    public function show(Request $request){
        $name_search = Doctor::where('name','like','%' . $request->name . '%')->paginate(20);
        return response()->json([
            'data'  => $name_search,
            'status'=> true
        ]);
    }
    
 public function deleteDoctor($latitude,$longitude){
    $doctor = Doctor::where('latitude', $latitude)->where('longitude', $longitude)->delete();
    if($doctor){
        $data=[
            'msg'=>'Success Delete Doctor'
          ];
    }
    else{
        $data=[
            'msg'=>'Fail Not Exists Doctor'
          ];
    }
    return response()->json($data);
 }
   public function updateDoctor($latitude,$longitude,Request $request){
    $doctor =  Doctor::where('latitude', $latitude)->where('longitude',$longitude)->update($request->all());
    $doctoru =  Doctor::where('latitude', $latitude)->where('longitude',$longitude)->get();
    if($doctoru){
       $data1 = [ 'data' => $doctoru,
           'status' =>'Success Update Record'];
    }else{
        $data1=['status'=>'Failed Update Record'];
    }
    return response()->json($data1);
    }
    public function searchId(Request $request){
        $doctor = Doctor::where('phone', 'LIKE', '%' . $request->phone . '%')->first();
        if($doctor == true){
            return response()->json([
                'data' => $doctor,
                'msg'   => 'success',
            ]);
        }
        return response()->json([
            'msg'   => 'faild',
        ]);
    }
}
