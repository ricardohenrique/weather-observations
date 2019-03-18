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

Route::post('observations', 'ObservationsController@store');
Route::get('statistics/temperature/max', 'StatisticsController@getMaxTemperature');
Route::get('statistics/temperature/min', 'StatisticsController@getMinTemperature');
Route::get('statistics/temperature/mean', 'StatisticsController@getMeanTemperature');
Route::get('statistics/observations', 'StatisticsController@getObservations');
Route::get('statistics/distance', 'StatisticsController@getDistance');
