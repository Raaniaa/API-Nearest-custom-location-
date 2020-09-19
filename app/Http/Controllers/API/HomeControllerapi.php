<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PharmacyResource;
class HomeControllerapi extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return response([ 'pharmacies' => new PharmacyResource($pharmacies) , 'message' => 'Retrieved successfully'], 200);
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
        return response([ 'position' => new PharmacyResource($position), 'message' => 'Created successfully'], 200,'position');
    }
}