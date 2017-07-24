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
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/home/{id}')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::get('/warehouses', 'WarehouseController@listAll')->name('user.warehouses');
});

Route::prefix('/user/{id}')->group(function() {
        Route::get('/', 'UserController@show')->name('user.id');
        Route::patch('/', 'UserController@update')->name('user.update');
        Route::delete('/', 'UserController@destroy')->name('user.destroy');
        Route::get('/warehouses', 'WarehouseController@listAll');
});

Route::prefix('/admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/form', 'AdminController@create')->name('admin.form.create');
    Route::post('/register', 'AdminController@register')->name('admin.form.register');
    Route::get('/list', 'AdminController@getAll')->name('admin.list');
    Route::get('/show-list', 'AdminController@showAll')->name('admin.list.show');


    Route::prefix('{id}')->group(function(){
        Route::get('/edit', 'AdminController@edit')->name('admin.edit');
        Route::post('/update', 'AdminController@update')->name('admin.update');
        Route::get('/show', 'AdminController@show')->name('admin.show');
        Route::delete('/delete', 'AdminController@destroy')->name('admin.delete');

    });
    /**
     * Route for admin/users;
     */
    Route::prefix('/users')->group(function(){
        Route::get('/', 'UserController@viewUsers')->name('admin.users.list.view');
        Route::get('/all', 'UserController@users')->name('admin.users.list');

        Route::prefix('/{id}')->group(function() {
            Route::get('/', 'UserController@show')->name('admin.user.show');
            Route::get('/edit', 'UserController@edit')->name('admin.user.edit');
            Route::patch('/', 'UserController@update')->name('user.update');
            Route::delete('/', 'UserController@destroy')->name('user.destroy');
        });
    });

    /**
     * Route for admin/warehouse
     */
    Route::prefix('/warehouses')->group(function(){
        Route::get('/show-list', 'WarehouseController@showList')->name('warehouses.show.list');
        Route::get('/', 'WarehouseController@listAll')->name('warehouses.all');
        Route::get('/names', 'WarehouseController@listNames')->name('warehouses.all.names');
        Route::get('/create', 'WarehouseController@create')->name('warehouses.create');
        Route::post('/register', 'WarehouseController@register')->name('warehouses.register');

        Route::prefix('/{id}')->group(function() {
            Route::get('/show', 'WarehouseController@show')->name('admin.warehouses.show');
            Route::get('/edit', 'WarehouseController@edit')->name('admin.warehouses.edit');
            Route::post('/update', 'WarehouseController@update')->name('warehouses.update');
            Route::delete('/delete', 'WarehouseController@destroy')->name('warehouses.destroy');
        });
    });

    Route::prefix('/subscriptions')->group(function(){
        Route::get('/show-list', 'SubscriptionController@showList')->name('subscriptions.show.list');
        Route::get('/', 'SubscriptionController@subscriptions')->name('subscriptions.all');
        Route::get('/create', 'SubscriptionController@subscriptionForm')->name('subscriptions.create');
        Route::post('/register', 'SubscriptionController@register')->name('subscriptions.register');

        Route::prefix('/{id}')->group(function() {
            Route::get('/show', 'SubscriptionController@show')->name('admin.subscriptions.show');
            Route::get('/show-form', 'SubscriptionController@subscriptionForm')->name('admin.subscriptions.show');
            Route::get('/edit', 'SubscriptionController@subscriptionForm')->name('admin.subscriptions.edit');
            Route::post('/update', 'SubscriptionController@update')->name('subscriptions.update');
            Route::delete('/delete', 'SubscriptionController@destroy')->name('subscriptions.destroy');
        });
    });

    Route::prefix('/status')->group(function(){
        Route::get('/', 'StatusController@showStatus')->name('status.all');
        Route::get('/warehouses', 'StatusController@warehouseStatus')->name('status.warehouse.all');

        Route::prefix('/{id}')->group(function(){
            Route::post('/', 'StatusController@update')->name('status.update');
            Route::delete('/', 'StatusController@destroy')->name('status.destroy');
        });
    });

    Route::prefix('/packages')->group(function(){
        Route::get('/show-list', 'PackageController@showList')->name('packages.show.list');
        Route::get('/', 'PackageController@warehousePackages')->name('packages.all');
        Route::get('/form', 'PackageController@form')->name('packages.create');
        Route::post('/register', 'PackageController@register')->name('packages.register');

        Route::prefix('/{id}')->group(function() {
            Route::get('/show-view', 'PackageController@showView')->name('admin.packages.showView');
            Route::get('/show', 'PackageController@show')->name('admin.packages.show');
//          Route::get('/form', 'PackageController@subscriptionForm')->name('admin.packages.form');
            Route::get('/edit', 'PackageController@form')->name('admin.packages.edit');
            Route::post('/update', 'PackageController@update')->name('packages.update');
            Route::delete('/file/{fileId}/delete', 'PackageFilesController@delete');
            Route::delete('/delete', 'PackageController@destroy')->name('packages.destroy');
        });
    });

});


