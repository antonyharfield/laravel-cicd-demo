<?php

use Illuminate\Http\Request;

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

Route::get('weather/{city}', 'WeatherController@simple');

Route::get('hospitals', 'HospitalController@index')->middleware('auth:api');

Route::get('hospitals/{id}', 'HospitalController@hospital');
Route::post('hospitals', 'HospitalController@createHospital');
