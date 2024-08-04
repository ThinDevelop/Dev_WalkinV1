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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
Route::get('login', ['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => '','uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout','uses' => 'Auth\LoginController@logout']);

Route::get('/external/appointment/{companyName}', 'Admin\AdminAppointmentController@externalIndex')->name('admin.appointment.external_index');
Route::post('/external/appointment', 'Admin\AdminAppointmentController@externalCreate')->name('admin.appointment.external_create');

// Route::get('/home', 'HomeController@index')->name('home');
