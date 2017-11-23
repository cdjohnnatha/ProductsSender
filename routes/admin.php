<?php
//Route::domain('admin.holyship.io.localhost')->group(function () {

    Auth::routes();
    Route::get('/', 'RedirectController@index');
<<<<<<< Updated upstream
    Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], functiongit  () {
=======
    Route::group(['namespace' => 'Admin', 'middleware' => ['web', 'type:admin']], function () {
>>>>>>> Stashed changes
        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
            Route::resource('company-warehouses', 'CompanyWarehouseController');

        });
        Route::resource('admin', 'AdminController');
    });
//});
