<?php


Route::group(['middleware' => ['auth:admin']], function(){
    Route::resource('admin', 'AdminController');
    Route::resource('users', 'UserController', ['as' => 'admin']);
    Route::resource('warehouses', 'WarehouseController', ['as' => 'admin']);
});
Route::prefix('/admin')->group(function() {


    Route::get('/login', 'Auth\AdminLoginController@index')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


    /**
     * Route for admin/warehouse
     */
    Route::prefix('/warehouses')->group(function(){
        Route::get('/show-list', 'WarehouseController@showList')->name('warehouses.show.list');
        Route::get('/', 'WarehouseController@listAll')->name('warehouses.all')->middleware('auth:admin,web');
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


