<?php


//Route::domain('app.dev.holyship.io.localhost')->group(function () {


    Auth::routes();

    Route::get('/locale/{locale}', 'LanguageController@update')->name('locale');

    Route::prefix('/register')->group(function () {
        Route::post('/', 'Auth\RegisterController@store')->name('register.submit');
        Route::get('/create', 'Auth\RegisterController@register')->name('register.create');
        Route::get('/verify/{confirmationCode}', 'Auth\RegisterController@confirm')->name('confirmation_path');
    });
    Route::get('/', 'RedirectController@index');
    Route::group(['namespace' => 'Web', 'middleware' => ['web', 'type:user']], function () {

        Route::group(['namespace' => 'Api'], function () {
            Route::get('/unread', 'UserNotificationsApiController@unread')->name('notifications.unread');
            Route::resource('shipment', 'ShipmentApiController');
            Route::post('/shipment/shipment-rates', 'ShipmentApiController@shipmentRates')->name('shipment.rates');

        });

        Route::group(['namespace' => 'Client'], function () {
            Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
                Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
                Route::get('/notifications', 'NotificationsController@notifications')->name('notifications');

                Route::resource('packages', 'ClientPackageController');
                Route::resource('notifications', 'NotificationsController');
                Route::get('read-all', 'NotificationsController@markAll')->name('notifications.mark.all');

            });

            Route::resource('user', 'UserController', ['except' => ['index']]);
        });
    });
//});

