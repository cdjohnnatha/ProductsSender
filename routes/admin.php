<?php
//Route::domain('admin.holyship.io.localhost')->group(function () {

    Auth::routes();
    Route::get('/', 'RedirectController@index');
    Route::group(['namespace' => 'Admin', 'middleware' => ['web', 'type:admin']], function () {

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');

            Route::resource('/companies', 'CompaniesController');
            Route::group(['as' => 'companies.', 'prefix' => 'companies/{company}'], function(){

                Route::resource('/addons', 'CompanyAddonsController');
                Route::resource('/warehouses', 'CompanyWarehouseController');

                Route::group(['as' => 'warehouses.', 'prefix' => 'warehouses/{warehouse}'], function(){
                    Route::resource('addons', 'CompanyWarehouseAddonsController');
                });

            });

        });
        Route::resource('admin', 'AdminController');
    });
//});
