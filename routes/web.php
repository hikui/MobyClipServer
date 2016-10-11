<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\FishRecord as FishRecord;

Route::get('/', function () {
    $fishRecords = FishRecord::whereNotNull("latitude")->whereNotNull("longitude")->take(10)->with("fishType")->get();
    return view('welcome')->with("fishRecords", $fishRecords);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
