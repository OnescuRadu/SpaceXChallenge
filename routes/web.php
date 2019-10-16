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
    return view('index');
});

Route::get('/rockets/{id}', function () {
    return view('rocket');
});



Route::get('/api/rockets', 'RocketController@getAll');

Route::get('/api/rockets/{id}', 'RocketController@get');

Route::get('/api/rockets/search/{search_query}', 'RocketController@search');