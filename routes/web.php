<?php

Route::domain('app.holyship.io')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });


    Auth::routes();

    Route::get('/locale/{locale}', 'LanguageController@update')->name('locale');

    Route::prefix('/register')->group(function () {
        Route::post('/', 'Auth\RegisterController@store')->name('register.submit');
        Route::get('/create', 'Auth\RegisterController@register')->name('register.create');
        Route::get('/subscriptions', 'SubscriptionController@subscriptions')->name('subscriptions.all');
        Route::get('/verify/{confirmationCode}', 'Auth\RegisterController@confirm')->name('confirmation_path');
    });

    Route::group(['middleware' => ['web']], function () {

        Route::group([
            'as' => 'user.',
            'prefix' => 'user'
        ], function () {
            Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
            Route::get('/notifications', 'NotificationsController@notifications')->name('notifications');

            Route::resource('address', 'AddressController');
            Route::post('address/{address}/default', 'AddressController@defaultAddress')->name('address.default');
            Route::resource('packages', 'PackageController', ['only' => ['show', 'index', 'destroy']]);

            Route::resource('additional-names', 'AdditionalNamesController', ['only' => [
                'index',
                'store',
                'destroy'
            ]]);

            Route::resource('/package/{package}/goods', 'GoodsDeclarationController', ['only' => ['create', 'destroy', 'store']]);
            Route::get('single_package/{package}', 'SinglePackageController@create')->name('single_package.create.selected');
            Route::resource('single_package', 'SinglePackageController');
            Route::resource('incoming', 'IncomingPackagesController');
            Route::resource('notifications', 'NotificationsController');
            Route::get('read-all', 'NotificationsController@markAll')->name('notifications.mark.all');
            Route::get('/unread', 'Api\UserNotificationsApiController@unread')->name('notifications.unread');
            Route::get('/show-package/{notification}', 'NotificationsController@readShow')->name('notifications.read.show');
            Route::post('/shipment/shipment-rates', 'Api\ShipmentApiController@shipmentRates')->name('shipment.rates');
            Route::resource('shipment', 'Api\ShipmentApiController');


        });

        Route::resource('user', 'UserController', ['except' => [
            'index'
        ]]);
    });

});

