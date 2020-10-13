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
        $banners = Banner::get();
        return response()->json([
                'data'  => $banners,
            ]);
    }

}