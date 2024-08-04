<?php

use App\Http\Controllers\Admin\AdminAppointmentController;

Route::group(['prefix' => 'admin',"namespace"=>"Admin"], function(){
    Route::group(['middleware' => ['role:admin']], function(){
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::get('/dashboard-visitor', 'AdminController@visitor')->name('admin.dashboardVisitor');
        Route::get('/dashboard-appointment', 'AdminController@appointment')->name('admin.dashboardAppointment');

        // Blacklist
        Route::get('/blacklist/contact', 'AdminBlacklistController@contactBlacklist');
        Route::get('/blacklist/dashboard', 'AdminBlacklistController@dashboardBlacklist');
        Route::get('/blacklist/delete', 'AdminBlacklistController@deleteBlacklist');
        Route::resource('/blacklist', 'AdminBlacklistController',[
            'names' => [
                'index' => 'admin.blacklist.index',
                'create' => 'admin.blacklist.create',
                'edit' => 'admin.blacklist.edit',
                'update' => 'admin.blacklist.update',
                'show'=> 'admin.blacklist.show',
                'destroy'=> 'admin.blacklist.destroy',
            ]
        ]);

        // ParkingPrice
        Route::get('/parkingprice', 'AdminController@index')->name('admin.parkingprice');
        Route::get('/parkingprice-setting', 'AdminController@setting')->name('admin.parkingpriceSetting');
        Route::get('/parkingprice-summary', 'AdminController@summary')->name('admin.parkingpriceSummary');

        // Appointment
        Route::get('/appointment/dashboard', 'AdminAppointmentController@dashboardAppointment');
        Route::resource('/appointment', 'AdminAppointmentController',[
            'names' => [
                'index' => 'admin.appointment.index',
                'create' => 'admin.appointment.create',
                'edit' => 'admin.appointment.edit',
                'store' => 'admin.appointment.store',
                'update' => 'admin.appointment.update',
            ]
        ]);

        // Parking
        Route::get('/parking/lists', 'AdminParkingController@lists');
        Route::resource('/parking', 'AdminParkingController',[
            'names' => [
                'index' => 'admin.parking.index',
                'update'=> 'admin.parking.update',
                'create' => 'admin.parking.create',
            ]
        ]);

        // Route::get('/Parking', 'AdminParkingController@chart');
        Route::get('/chartParkingDaily', 'AdminParkingController@chartParkingToday');
        Route::get('/chartParkingMonth', 'AdminParkingController@chartParkingMonth');
        Route::get('/chartParkingYear', 'AdminParkingController@chartParkingYear');

        // Route::get('/contact/all', 'AdminContactController@all')->name('admin.contact.all');
        Route::get('/contact/{type}', 'AdminContactController@showList')->name('admin.contact.list');
        Route::get('/get/contact', 'AdminContactController@showGet')->name('admin.contact.get');
        Route::get('/print/contact/{code}', 'AdminContactController@printContact')->name('admin.contact.print');
        Route::get('/users/{type}', 'AdminUserController@showList')->name('admin.user.list');
        // Route::put('/changePassword', 'AdminUserController@changePassword')->name('admin.changepassword');
        Route::get('/export/contact-transection', 'AdminController@export');
        Route::get('/change-password', 'AdminUserController@changePassword')->name('admin.changePassword');
        Route::post('/change-password/submit', 'AdminUserController@changePasswordSubmit')->name('admin.change.password');

        Route::get('/report/today', 'AdminReportController@Today')->name('admin.report.today');
        Route::get('/report/week', 'AdminReportController@Week')->name('admin.report.week');
        Route::get('/report/month', 'AdminReportController@Month')->name('admin.report.month');
        Route::get('/report/custom', 'AdminReportController@CustomDate')->name('admin.report.custom');
        Route::get('/report/list/{date_start}/{date_from}', 'AdminReportController@listDate')->name('admin.report.list');
        Route::get('/report/files', 'AdminReportController@Export')->name('admin.report.files');

    });
});
