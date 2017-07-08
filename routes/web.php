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
    Route::post('/', 'UserController@store')->name('register.submit');
    Route::get('/form', 'Auth\RegisterController@registerForm')->name('register.form');
    Route::post('/user', 'Auth\RegisterController@registerUser')->name('register.user');
    Route::get('/address', 'Auth\RegisterController@addressForm')->name('register.address.form');
    Route::post('/address', 'Auth\RegisterController@registerAddress')->name('register.address');
    Route::get('/plan', 'Auth\RegisterController@showPlans')->name('register.plan');
    Route::post('/plan', 'Auth\RegisterController@registerAccount')->name('register.account');
    Route::get('/subscriptions', 'SubscriptionController@index')->name('subscriptions.all');
});




Route::get('/home/all', 'HomeController@showall')->name('home.all');
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/home/{id}')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/edit', 'HomeController@edit')->name('user.edit');
});

Route::prefix('/user')->group(function() {
    Route::get('/', 'UserController@listAll')->name('users');

    Route::prefix('/{id}')->group(function() {
        Route::get('/', 'UserController@show')->name('user.id');
        Route::patch('/', 'UserController@update')->name('user.update');
        Route::delete('/', 'UserController@destroy')->name('user.destroy');

        Route::prefix('/address')->group(function() {
            Route::get('/', 'AddressController@create')->name('user.address.create');
            Route::post('/', 'AddressController@register')->name('user.address.register');
        });
    });
});

Route::prefix('/admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');


});