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

Route::middleware('auth:web')->prefix('/user/{id}')->group(function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/', 'UserController@update')->name('user.update');
    Route::get('/warehouses', 'WarehouseController@listAll')->name('user.warehouses');
    Route::get('/unread', 'HomeController@unread')->name('home.packages.unread');
    Route::get('/notifications', 'HomeController@notifications')->name('home.notifications.all');
    Route::get('/show-notifications', 'HomeController@showNotifications')->name('home.notifications.view');
    Route::get('/mark-read', 'HomeController@markRead')->name('home.notification.markread');

    //User packages
    Route::prefix('/packages')->group(function(){
        Route::get('/', 'UserPackageHandleController@userDefaultPackages')->name('home.get.packages');
        Route::get('/show-list', 'UserPackageHandleController@table')->name('home.packages');
        Route::get('/inform', 'UserPackageHandleController@informPackage')->name('home.packages.inform');
         Route::prefix('/{packageId}')->group(function(){
            Route::get('/', 'PackageController@showView')->name('home.packages.package');
        });
    });
});

