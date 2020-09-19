<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::apiResource('/pharmacies', 'App\Http\Controllers\Api\HomeControllerapi');
Route::get('details', function () {

	$ip = '1';
    $data = \Location::get($ip);
    dd($data->countryName);
   
});
Route::get('get-location-from-ip',function(){
    $ip= \Request::ip();
    $data = \Location::get($ip);
    dd($data);
});