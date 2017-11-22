<?php
//Route::domain('admin.holyship.io.localhost')->group(function () {

    Auth::routes();

    Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {
        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
            Route::resource('users', 'UserController');


        });
        Route::resource('admin', 'AdminController');
    });
//});
