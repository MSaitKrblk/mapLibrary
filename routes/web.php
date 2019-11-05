<?php

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

Route::get('/', function () {
    return view('mapBoard');
});
Route::get('/ajaxexample', function () {
    return view('ajaxExample');
});

Route::get('/ajaxLocationRequest', 'locationController@ajaxLocationRequestGet');

Route::post('/ajaxLocationRequest', 'locationController@ajaxLocationRequestPost');

Route::post('/ajaxUpdateLocationRequest', 'locationController@ajaxUpdateLocationRequestPost');

Route::post('/ajaxsearchLocationRequest', 'locationController@ajaxsearchLocationRequestPost');
?>