<?php

Auth::routes();
Route::get('/', 'RedirectController@index');
Route::group(['namespace' => 'Web', 'middleware' => ['web', 'type:admin']], function () {

    Route::group(['namespace' => 'Api'], function () {
        Route::get('/admin/api/findClient/{id}', 'ClientApiController@findSuite')->name('find-suite');
        Route::delete('/admin/api/deleteFile/{id}', 'PackageApiController@destroyFile')->name('delete-package-file');
    });

    Route::group(['namespace' => 'Admin'], function () {

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');

            Route::resource('/companies', 'CompaniesController');
            Route::group(['as' => 'companies.', 'prefix' => 'companies/{company}'], function () {
                Route::resource('/addons', 'CompanyAddonsController');
                Route::resource('/warehouses', 'CompanyWarehouseController');

                Route::group(['as' => 'warehouses.', 'prefix' => 'warehouses/{warehouse}'], function () {
                    Route::resource('addons', 'CompanyWarehouseAddonsController');
                    Route::resource('fees', 'CompanyWarehouseFeeRulesController', ['except' => ['index', 'show']]);
                    Route::resource('weight-fees', 'FeeWeightRulesController', ['except' => ['index', 'show']]);
                    Route::resource('orders', 'CompanyWarehouseOrders');
                });

            });

            Route::resource('/packages', 'PackagesController');

        });
        Route::resource('admin', 'AdminController');
    });
});
