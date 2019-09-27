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
Route::get('/create', 'MeetingController@create')->name('create');
Route::post('/save_data', 'MeetingController@save_data')->name('save_data');

