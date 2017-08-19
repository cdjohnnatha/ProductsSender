<?php

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::group(['middleware' => ['auth:admin']], function(){
    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin'
        ], function() {
            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
            Route::resource('users', 'UserController');
            Route::resource('warehouses', 'WarehouseController');
            Route::resource('packages', 'PackageController');
            Route::resource('status', 'StatusController');
            Route::resource('subscriptions', 'SubscriptionController');
            Route::delete('benefits/{benefit}', 'BenefitController@destroy')->name('benefits.destroy');
            Route::delete('packagefiles/{pictureId}', 'PackageFilesController@destroy')->name('packagefiles.destroy');
    });
    Route::resource('admin', 'AdminController');
});


