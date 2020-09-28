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

Route::group(['namespace' => 'Api'], function () {

});
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');

// PHARMACIES ROUTES
Route::apiResource('/pharmacies', 'App\Http\Controllers\Api\HomeControllerApi');
Route::get('/pharmacies/search', 'App\Http\Controllers\Api\HomeControllerApi@show');
Route::post('/allpharmacies', 'App\Http\Controllers\Api\HomeControllerApi@getAllPharmacy');
//Doctor
Route::post('/doctor', 'App\Http\Controllers\Api\DoctorControllerApi@store');
Route::post('/doctors', 'App\Http\Controllers\Api\DoctorControllerApi@getAllDoctor');
Route::get('/doctor/search', 'App\Http\Controllers\Api\DoctorControllerApi@show');
Route::get('/doctor', 'App\Http\Controllers\Api\DoctorControllerApi@index');
//Specialty
Route::post('/specialty', 'App\Http\Controllers\Api\SpecialtyControllerApi@store');
Route::post('/specialties', 'App\Http\Controllers\Api\SpecialtyControllerApi@getAllSpecialty');
Route::get('/specialty/search', 'App\Http\Controllers\Api\SpecialtyControllerApi@show');
Route::get('/specialty', 'App\Http\Controllers\Api\SpecialtyControllerApi@index');