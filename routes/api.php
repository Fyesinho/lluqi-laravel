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

Route::post('login', 'UserAPIController@login');
Route::post('register', 'UserAPIController@register');
Route::post('logout', 'UserAPIController@logout');


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('user', 'UserAPIController@update');
    Route::get('user', 'UserAPIController@getInfo');

    Route::post('chat', 'ChatAPIController@createChat');
    Route::get('chat', 'ChatAPIController@chats');
    Route::get('chat/{id}', 'ChatAPIController@messages');
    Route::post('chat/{id}/message', 'ChatAPIController@newMessage');

    Route::get('plan', 'PlanAPIController@index');
    Route::post('plan', 'PlanAPIController@store');
    //Route::post('plan/{id}/', 'PlanAPIController@update');
});

Route::resource('pruebas', 'PruebaAPIController');
Route::resource('languages', 'LanguageAPIController');
Route::resource('countries', 'CountryAPIController');
Route::resource('travelers', 'TravelerAPIController');
Route::resource('cities', 'CityAPIController');
Route::resource('need_activities', 'NeedActivityAPIController');
Route::resource('offers', 'OfferAPIController');
Route::resource('hostels', 'HostelAPIController');
Route::resource('hostel_activities', 'HostelActivityAPIController');
Route::resource('hostel_offers', 'HostelOfferAPIController');
Route::resource('images', 'ImagesAPIController');
Route::resource('months', 'MonthAPIController');
Route::resource('hostel_months', 'HostelMonthAPIController');
Route::resource('genders', 'GenderAPIController');

Route::get('destinations', 'DestinationsAPIController@index');
Route::get('testimonials', 'TestimonialAPIController@index');

Route::post('postulation', 'PostulationAPIController@store');

