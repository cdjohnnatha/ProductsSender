<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/warehouse', 'WarehouseController@listAll')->name('warehouses.all');


Route::prefix('/register')->group(function() {
    Route::post('/', 'Auth\RegisterController@store')->name('register.submit');
    Route::get('/form', 'Auth\RegisterController@registerForm')->name('register.form');
    Route::get('/subscriptions', 'SubscriptionController@subscriptions')->name('subscriptions.all');
});

Route::get('/home/all', 'HomeController@showall')->name('home.all');

Route::prefix('/user/{id}')->group(function() {

    Route::resource('/address', 'AddressController', ['as' => 'user']);
    Route::post('/test', 'UserController@test');
    Route::get('/', 'HomeController@index')->name('user');
    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/', 'UserController@update')->name('user.update');
    Route::get('/warehouses', 'WarehouseController@listAll')->name('user.warehouses');
    Route::get('/unread', 'HomeController@unread')->name('user.packages.unread');
    Route::get('/notifications', 'HomeController@notifications')->name('user.notifications.all');
    Route::get('/show-notifications', 'HomeController@showNotifications')->name('user.notifications.view');
    Route::get('/mark-read', 'HomeController@markRead')->name('user.notification.markread');

    //User packages
    Route::prefix('/packages')->group(function(){
        Route::get('/', 'UserPackageHandleController@userDefaultPackages')->name('user.get.packages');
        Route::get('/show-list', 'UserPackageHandleController@table')->name('user.packages');
        Route::get('/inform', 'UserPackageHandleController@informPackage')->name('user.packages.inform');
         Route::prefix('/{packageId}')->group(function(){
            Route::get('/', 'PackageController@showView')->name('user.packages.package');
        });
    });

    Route::prefix('/additional-names')->group(function(){
        Route::get('/', 'AdditionalNamesController@create')->name('user.additionaNames.view');
        Route::get('/names', 'AdditionalNamesController@names')->name('user.additionaNames.all');

    });
});

