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
  return redirect('home');
});


Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');

    Route::resource('countries', 'CountryController');
    Route::resource('pruebas', 'PruebaController');
    Route::resource('languages', 'LanguageController');
    Route::resource('travelers', 'TravelerController');
    Route::resource('cities', 'CityController');
    Route::resource('needActivities', 'NeedActivityController');
    Route::resource('offers', 'OfferController');
    Route::resource('hostels', 'HostelController');
    Route::resource('hostelActivities', 'HostelActivityController');
    Route::resource('hostelOffers', 'HostelOfferController');
    Route::resource('images', 'ImagesController');
    Route::resource('months', 'MonthController');
    Route::resource('hostelMonths', 'HostelMonthController');
    Route::resource('genders', 'GenderController');
});