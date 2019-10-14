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

Route::get('/delete/{id}', 'MeetingController@destroy')->name('destroy');

Route::post('/remove_image', 'MeetingController@remove_image')->name('remove_image');


Route::get('/verticals_list', 'VerticalsController@index')->name('list_vertical');
Route::post('/save_verticals', 'VerticalsController@save_vertical')->name('save_vertical');
Route::get('/create_vertical', 'VerticalsController@create_vertical')->name('create_vertical');
Route::get('/edit_vertical/{id}', 'VerticalsController@edit_vertical')->name('edit_vertical');
Route::post('/update_vertical', 'VerticalsController@update_vertical')->name('update_vertical');
Route::get('/delete_vertical/{id}', 'VerticalsController@destroy')->name('destroy');

Route::post('/fetch_vertical', 'MeetingController@fetch_sub_vertical')->name('fetch_sub_vertical');


//API links

Route::get('/meeting_list_data/', 'MeetingController@meeting_list')->name('meeting_list');

Route::get('/meeting_data/{id}', 'MeetingController@meeting_data')->name('meeting_data');


// Live_Polling Routes
Route::get('/live_pollings', 'LivePollingModelController@index')->name('live_pollings');
Route::get('/create_live_polling', 'LivePollingModelController@create_live_polling')->name('create_live_polling');
Route::post('/store_live_polling', 'LivePollingModelController@store_live_polling')->name('store_live_polling');
Route::get('/show_live_polling', 'LivePollingModelController@show_live_polling')->name('show_live_polling');
Route::get('/edit_live_polling/{id}', 'LivePollingModelController@edit_live_polling')->name('edit_live_polling');
Route::post('/update_live_polling/{id}', 'LivePollingModelController@update_live_polling')->name('update_live_polling');
Route::get('/delete_live_polling/{id}', 'LivePollingModelController@delete_live_polling')->name('delete_live_polling');
Route::get('/live_pollings', 'LivePollingModelController@index')->name('live_pollings');


// Welcome Message

Route::get('/create_message', 'WelcomeMessageController@create_message')->name('create_message');
Route::post('/save_message', 'WelcomeMessageController@save_message')->name('save_message');
Route::get('/message_list', 'WelcomeMessageController@index')->name('message_list');
Route::get('/edit_message/{id}', 'WelcomeMessageController@edit_message')->name('edit_message');
Route::post('/update_message', 'WelcomeMessageController@update_message')->name('update_message');
Route::get('/delete_message/{id}', 'WelcomeMessageController@destroy')->name('destroy');


// scheduler Route
Route::get('/schedulers', 'SchedulersController@index');
Route::post('/store_schedules', 'SchedulersController@store_schedules')->name('store_schedules');
