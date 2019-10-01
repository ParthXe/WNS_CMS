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
     return redirect(route('login'));
});
Route::group(['middleware' => 'auth'], function () {
  /*Route::get('/', function () {
        return view('show_event');
   });*/
  // Route::get('/','LoginController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');                                                      
Route::get('/test', 'HomeController@test')->name('test');

Route::get('/meeting_list', 'MeetingController@index')->name('list');

Route::get('/create', 'MeetingController@create')->name('create');
Route::post('/save_data', 'MeetingController@save_data')->name('save_data');
Route::get('/edit/{id}', 'MeetingController@edit')->name('edit');
Route::post('/update', 'MeetingController@update_meeting')->name('update_meeting');

Route::post('/remove_image', 'MeetingController@remove_image')->name('remove_image');


Route::get('/verticals_list', 'VerticalsController@index')->name('list_vertical');
Route::post('/save_verticals', 'VerticalsController@save_vertical')->name('save_vertical');
Route::get('/create_vertical', 'VerticalsController@create_vertical')->name('create_vertical');
Route::post('/fetch_vertical', 'MeetingController@fetch_sub_vertical')->name('fetch_sub_vertical');

