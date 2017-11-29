<?php
//Route::domain('admin.holyship.io.localhost')->group(function () {

    Auth::routes();
    Route::get('/', 'RedirectController@index');
    Route::group(['namespace' => 'Admin', 'middleware' => ['web', 'type:admin']], function () {
        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
            Route::resource('companies', 'CompaniesController');
            Route::resource('company-addons', 'CompanyAddonsController');
            Route::resource('company-warehouses', 'CompanyWarehouseController');
        });
        Route::resource('admin', 'AdminController');
    });
//});
