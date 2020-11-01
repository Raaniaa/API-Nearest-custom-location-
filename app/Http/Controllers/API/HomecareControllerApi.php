<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Homecare;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class HomecareControllerApi extends Controller
{
public function HomecareStore(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'address'=>'required',
            'phone'=>'required',
            'specialtyName'=>'required',
            'photo'=> '',
            'homecare'=>'',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $homecare = Homecare::create($data);
     
    
        return response([
            'data' => $homecare,
            'message' => 'Created successfully'], 200);
    }
public function getAllhomecare() 
    {
        $homecare = Homecare::paginate(20);
        //dd($doctors);
        return response()->json([
                'data'  => $homecare,
            ]);
    }
public function homecareDelete($phone)
 {
   $homecare = Homecare::Where('phone',$phone)->delete();
    if($homecare){
      $data = [
        'msg'=>'Success Delete Homecare'
    ];
    }else{
      $data=[
        'msg'=>'Fail Not Exists Homecare'
      ];
      }
 return response()->json($data);
    }   


public function index(Request $request)
     {
        $homecares = $this->getNearby($request);
        return response([
            'data' => $homecares ,
            'message' => 'Retrieved successfully'], 200);
     }
private function getNearby($request)
    {
        $latitudeTo = $request->latitude;
        $longitudeTo = $request->longitude;
        $specialty = $request->specialtyName;
        $earthRadius = 6378137; // earth radius it's fixed value 6378137

        $nearbyHomecares = [];

        $homecares = Homecare::where('specialtyName', 'LIKE', $request->name.'%')->paginate(20);

        foreach ($homecares as $homecare) {
            $latitudeFrom = $homecare->latitude;
            $longitudeFrom = $homecare->longitude;

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
          //  $distance = $distance >= 1000 ? (round($distance/1000, 2)) : $distance;
            $homecare->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyHomecares, $homecare);
        }

        if (count($nearbyHomecares)) {
            return $nearbyHomecares;
        }
}
 public function searchphone(Request $request){
    $homecare = Homecare::where('phone', 'LIKE', '%' . $request->phone . '%')->first();
    if($homecare == true){
        return response()->json([
            'data' => $homecare,
            'msg'   => 'success',
        ]);
    }
    return response()->json([
        'msg'   => 'faild',
    ]);
    
 }
}