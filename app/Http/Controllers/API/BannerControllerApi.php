<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BannerControllerApi extends Controller
{
    public function getBanner(){
        $banners = Banner::count();
        if ($banners){
            $banner = Banner::paginate(20);
            return response([
                'data' => $banner ,
                'message' => 'success'], 200);
            }else{
                return response(['message' => 'failed']);
            }
    }

}