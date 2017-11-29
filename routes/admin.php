<?php
//Route::domain('admin.holyship.io.localhost')->group(function () {

    Auth::routes();
    Route::get('/', 'RedirectController@index');
    Route::group(['namespace' => 'Admin', 'middleware' => ['web', 'type:admin']], function () {
        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
            Route::group(['as' => 'companies.', 'prefix' => 'companies'], function(){
                Route::resource('/', 'CompaniesController');
                Route::resource('addons', 'CompanyAddonsController');

                Route::group(['as' => 'warehouses.', 'prefix' => 'warehouses'], function(){
                    Route::resource('/', 'CompanyWarehouseController');
                    Route::resource('addons', 'CompanyWarehouseAddonsController');
                });

            });

        });
        Route::resource('admin', 'AdminController');
    });
//});
