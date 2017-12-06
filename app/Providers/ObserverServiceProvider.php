<?php

namespace App\Providers;

use App\Entities\Package\Package;
use App\Observers\PackageObserver;
use App\Observers\WarehouseObserver;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application addons.
     *
     * @return void
     */
    public function boot()
    {
        Package::observe(PackageObserver::class);
        Package::observe(WarehouseObserver::class);
    }

    /**
     * Register the application addons.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
