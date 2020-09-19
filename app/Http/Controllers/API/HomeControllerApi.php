<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PharmacyResource;
class HomeControllerApi extends Controller
{
    public function index(Request $request)
    {
        $pharmacies = $this->getNearby($request);
        return response([
            'pharmacies' => $pharmacies ,
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

        $nearbyPharmacies = [];

        $pharmacies = Pharmacy::where('name', 'LIKE', "%$request->name%")->get();

        foreach ($pharmacies as $pharmacy) {
            $latitudeFrom = $pharmacy->lat;
            $longitudeFrom = $pharmacy->lng;

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
            $pharmacy->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyPharmacies, $pharmacy);
        }

        if (count($nearbyPharmacies)) {
            return $nearbyPharmacies;
        }
    }


    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'lat' => 'required|max:255',
            'lng' => 'required|max:255',
            'phone' => 'required',
            'address'=>'required',
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $position = Location::get();

        $pharmacies = Pharmacy::create($data);
        return response([
            'position' => new PharmacyResource($position),
            'message' => 'Created successfully'], 200,'position');
    }
}
