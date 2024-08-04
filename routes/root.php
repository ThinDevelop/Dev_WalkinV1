<?php

Route::group(['prefix' => 'root',"namespace"=>"Root"], function(){
    Route::group(['middleware' => ['role:root']], function(){
        Route::get('/dashboard', 'RootController@index')->name('root.dashboard');
        Route::post('/deleteCompany', 'RootCompanyController@DeleteCompany')->name('root.deleteCompany');
        Route::post('/deleteDevice', 'RootDeviceController@DeleteDevice')->name('root.deleteDevice');
        Route::get('/report/month', 'RootReportController@Month')->name('root.report.month');
        Route::get('/report/custom', 'RootReportController@CustomDate')->name('root.report.custom');
        Route::get('/report/list/{date_start}/{date_from}', 'RootReportController@listDate')->name('root.report.list');
        // Route::post('/company', 'RootCompanyController@store');

        Route::get('/change/password', 'RootUserController@changePassword')->name('root.change.password');
        Route::put('/change/password', 'RootUserController@changePasswordSubmit')->name('root.change.password.submit');

        Route::resource('/device', 'RootDeviceController',[
            'names' => [
                'index'     => 'root.device.index',
                'store'     => 'root.device.store',
                'create'    => 'root.device.create',
                'destroy'   => 'root.device.destroy',
                'show'      => 'root.device.show',
                'update'    => 'root.device.update',
                'edit'      => 'root.device.edit',
            ]
        ]);

        Route::resource('/company', 'RootCompanyController',[
            'names' => [
                'index'     => 'root.company.index',
                'store'     => 'root.company.store',
                'create'    => 'root.company.create',
                'destroy'   => 'root.company.destroy',
                'show'      => 'root.company.show',
                'update'    => 'root.company.update',
                'edit'      => 'root.company.edit',
            ]
        ]);


        Route::resource('/user', 'RootUserController',[
            'names' => [
                'index'     => 'root.user.index',
                'store'     => 'root.user.store',
                'create'    => 'root.user.create',
                'destroy'   => 'root.user.destroy',
                'show'      => 'root.user.show',
                'update'    => 'root.user.update',
                'edit'      => 'root.user.edit',
            ]
        ]);

        Route::resource('/account', 'RootAccountController',[
            'names' => [
                'index'     => 'root.account.index',
                'store'     => 'root.account.store',
                'create'    => 'root.account.create',
                'destroy'   => 'root.account.destroy',
                'show'      => 'root.account.show',
                'update'    => 'root.account.update',
                'edit'      => 'root.account.edit',
            ]
        ]);



    });
});
