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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->prefix('v1')->group( function(){
    // Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'ApiLoginController@login');
        Route::post('checkdevice', 'ApiLoginController@device');
    
        Route::group(['middleware' => 'auth:api'], function() {
    
            Route::get('summary', 'ApiContactTransectionController@Summary');
            Route::post('checkin', 'ApiContactTransectionController@CheckIn');
            Route::post('checkout', 'ApiContactTransectionController@CheckOut');
            Route::post('check/appointmnet', 'ApiContactTransectionController@CheckAppointment');
            Route::get('check/pdpa', 'ApiContactTransectionController@CheckPDPA');

            Route::get('search/way', 'ApiContactTransectionController@SearchWay');
            Route::get('search/order', 'ApiContactTransectionController@SearchOrder');
            Route::get('search/listbytype', 'ApiContactTransectionController@ListByType');
            Route::get('search/detaillist/{id}', 'ApiContactTransectionController@DetailList');

            
            Route::get('print/order', 'ApiContactTransectionController@PrintOrder');

        });
    });
    
