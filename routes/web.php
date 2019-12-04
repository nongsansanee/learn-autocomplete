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
    return view('autocomplete');
});

Route::get('/get-cities', function () {
    $search = request()->input('search');
    // $cities = \App\City::limit(50)->get();
    $cities = \App\City::SearchCities($search)->get();

    return $cities;
});