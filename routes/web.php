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


Route::prefix('/register')->group(function() {
    Route::post('/', 'Auth\RegisterController@store')->name('register.submit');
    Route::get('/form', 'Auth\RegisterController@registerForm')->name('register.form');
    Route::get('/subscriptions', 'SubscriptionController@subscriptions')->name('subscriptions.all');
});

Route::group(['middleware' => ['web']], function() {

    Route::group([
        'as' => 'user.',
        'prefix' => 'user/{user}'
    ], function() {
        Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
        Route::get('/notifications', 'UserNotificationsController@notifications')->name('notifications');
        Route::get('/unread', 'UserNotificationsController@unread')->name('notifications.unread');
        Route::resource('packages', 'PackageController', ['only' => [
            'show'
        ]]);
        Route::resource('notifications', 'UserNotificationsController', ['only' => [
            'index',
            'destroy',
            'show'
        ]]);

        Route::resource('additional-names', 'AdditionalNamesController', ['only' => [
            'index',
            'store',
            'destroy'
        ]]);
    });

    Route::resource('user', 'UserController');
});

