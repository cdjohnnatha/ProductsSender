<?php

namespace App\Providers;

use App\Library\Services\Shipment;
use Illuminate\Support\ServiceProvider;

class ShipmentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Shipment::class, function($app){
           return new Shipment();
        });
    }
}
