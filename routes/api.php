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

Route::post('login', 'UserApiController@login');
Route::post('register', 'UserApiController@register');
Route::post('logout', 'UserApiController@logout');


//Route::group(['middleware' => 'auth:api'], function(){
    Route::patch('user', 'UserAPIController@update');

    Route::resource('pruebas', 'PruebaAPIController');
    Route::resource('languages', 'LanguageAPIController');
    Route::resource('countries', 'CountryAPIController');
    Route::resource('travelers', 'TravelerAPIController');
    Route::resource('cities', 'CityAPIController');
    Route::resource('need_activities', 'NeedActivityAPIController');
    Route::resource('offers', 'OfferAPIController');
    Route::resource('hostels', 'HostelAPIController');
    Route::resource('genders', 'GenderAPIController');
    Route::resource('hostels', 'HostelAPIController');
    Route::resource('hostel_activities', 'HostelActivityAPIController');
    Route::resource('hostel_offers', 'HostelOfferAPIController');
    Route::resource('images', 'ImagesAPIController');
    Route::resource('months', 'MonthAPIController');
    Route::resource('hostel_months', 'HostelMonthAPIController');
    Route::resource('genders', 'GenderAPIController');

//});