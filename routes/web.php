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
    Route::get('travelers/export', 'TravelerController@exportToExcel')->name('travelers.export');

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

    Route::get('chat', 'ChatController@chats')->name('chats');
    Route::post('chat', 'ChatController@store')->name('chat.store');
    Route::get('chat/{id}', 'ChatController@chatById')->name('chatById');

    Route::resource('destination', 'DestinationsController');
    Route::resource('user', 'UserController');

    Route::resource('testimonial', 'TestimonialController');
    Route::resource('plan', 'PlanController');

});

Route::get('postulation', 'PostulationController@index')->name('postulation');
