<?php

Route::group(['prefix' => 'superadmin',"namespace"=>"SuperAdmin"], function(){
    Route::group(['middleware' => ['role:super-admin']], function(){
        Route::get('/dashboard', 'SuperAdminController@index')->name('superadmin.dashboard');
        Route::get('/dashboard/detail/{type}/{company_id}', 'SuperAdminController@contactDetail')->name('superadmin.contactList.show');
        Route::get('/dashboard/contact', 'SuperAdminController@getContact')->name('superadmin.dashboard.contact');

        Route::get('/dashboard-visitor', 'SuperAdminController@visitor')->name('superadmin.dashboardVisitor');
        Route::get('/dashboard-visitor/detail/{type}/{company_id}', 'SuperAdminController@contactDetailVisitor')->name('superadmin.contactListVisitor.show');
        Route::get('/dashboard-visitor/contact', 'SuperAdminController@getContact')->name('superadmin.dashboardVisitor.contact');

        Route::get('/dashboard-parking', 'SuperAdminController@parking')->name('superadmin.dashboardParking');
        Route::get('/dashboard-parking/contact', 'SuperAdminController@getContactParking')->name('superadmin.dashboardParking.contact');


        Route::get('/get/contact', 'SuperAdminController@showGet')->name('superadmin.contact.get');
        
        Route::get('/profile', 'SuperAdminController@profile')->name('superadmin.profile');
        
        Route::get('/change-password', 'SuperAdminController@changePassword')->name('superadmin.changePassword');
        Route::post('/change-password/submit', 'SuperAdminController@changePasswordSubmit')->name('superadmin.change.password');

        Route::get('/getUser', 'SuperAdminUserController@getUser')->name('superadmin.getUser');
        Route::get('/getCompany', 'SuperAdminCompanyController@getCompany')->name('superadmin.getCompany');
        Route::get('/getRoleNames', 'SuperAdminRoleController@getRoleNames')->name('superadmin.getRoleNames');
        Route::get('/getUserByCompanyId', 'SuperAdminUserController@getUserByCompanyId')->name('superadmin.getUserByCompanyId');
        Route::get('/export/contact-transection', 'SuperAdminController@export');
        Route::resource('/user', 'SuperAdminUserController',[
            'names' => [
                'index' => 'superadmin.user.index',
                'store' => 'superadmin.user.store',
                'create' => 'superadmin.user.create',
                'destroy'=> 'superadmin.user.destroy',
                'show'=> 'superadmin.user.show',
                'update'=> 'superadmin.user.update',
                'edit'=> 'superadmin.user.edit',
            ]
        ]);
        Route::post('/user/saveDataUserFromCompany', 'SuperAdminUserController@saveDataUserFromCompany')->name('superadmin.saveDataUserFromCompany');


        Route::resource('/company', 'SuperAdminCompanyController',[
            'names' => [
                'index' => 'superadmin.company.index',
                'store' => 'superadmin.company.store',
                'create' => 'superadmin.company.create',
                'destroy'=> 'superadmin.company.destroy',
                'show'=> 'superadmin.company.show',
                'update'=> 'superadmin.company.update',
                'edit'=> 'superadmin.company.edit',
            ]
        ]);

        Route::resource('/signature-form', 'SuperAdminSignatureFormController',[
            'names' => [
                'index' => 'superadmin.signature.index',
                'store' => 'superadmin.signature.store',
                'create' => 'superadmin.signature.create',
                'destroy'=> 'superadmin.signature.destroy',
                'show'=> 'superadmin.signature.show',
                'update'=> 'superadmin.signature.update',
                'edit'=> 'superadmin.signature.edit',
            ]
        ]);
        Route::post('/signature-form/saveDataSignature', 'SuperAdminSignatureFormController@saveDataSignature')->name('superadmin.saveDataSignature');


        Route::resource('/objective-type', 'SuperAdminObjectiveTypeController',[
            'names' => [
                'index' => 'superadmin.objective.index',
                'store' => 'superadmin.objective.store',
                'create' => 'superadmin.objective.create',
                'destroy'=> 'superadmin.objective.destroy',
                'show'=> 'superadmin.objective.show',
                'update'=> 'superadmin.objective.update',
                'edit'=> 'superadmin.objective.edit',
            ]
        ]);

        Route::post('/objective-type/saveDataObjectiveType', 'SuperAdminObjectiveTypeController@saveDataObjectiveType')->name('superadmin.saveDataObjectiveType');

        Route::resource('/departments', 'SuperAdminDepartmentsController',[
            'names' => [
                'index' => 'superadmin.department.index',
                'store' => 'superadmin.department.store',
                'create' => 'superadmin.department.create',
                'destroy'=> 'superadmin.department.destroy',
                'show'=> 'superadmin.department.show',
                'update'=> 'superadmin.department.update',
                'edit'=> 'superadmin.department.edit',
            ]
        ]);

        Route::post('/departments/saveDataDepartments', 'SuperAdminDepartmentsController@saveDataDepartments')->name('superadmin.saveDataDepartments');

        Route::resource('/roles', 'SuperAdminRoleController',[
            'names' => [
                'index' => 'superadmin.role.index',
                'store' => 'superadmin.role.store',
                'create' => 'superadmin.role.create',
                'destroy'=> 'superadmin.role.destroy',
                'show'=> 'superadmin.role.show',
                'update'=> 'superadmin.role.update',
                'edit'=> 'superadmin.role.edit',
            ]
        ]);

        Route::put('/savenote', 'SuperAdminNoteController@saveDataNote');

        Route::get('/report/today', 'SuperAdminReportController@Today')->name('superadmin.report.today');
        Route::get('/report/week', 'SuperAdminReportController@Week')->name('superadmin.report.week');
        Route::get('/report/month', 'SuperAdminReportController@Month')->name('superadmin.report.month');
        Route::get('/report/custom', 'SuperAdminReportController@CustomDate')->name('superadmin.report.custom');
        Route::get('/report/list/{date_start}/{date_from}', 'SuperAdminReportController@listDate')->name('superadmin.report.list');
        Route::get('/report/files', 'SuperAdminReportController@Export')->name('superadmin.report.files');

        Route::post('/send-message', 'LineNotifyController@sendMessage');
        Route::get('/download-pdf/{filename}', 'PDFController@downloadPDF')->name('download.pdf');

    });
});
