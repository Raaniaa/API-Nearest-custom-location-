<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/doctor',function(){
    $doc = \App\Models\Doctor::with('specialty')->find(1);
    return $doc->specialty->specialtyName;
});