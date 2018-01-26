<?php

namespace App\Providers;

use App\Entities\Order\OrderFoward;
use App\Entities\Package\Package;
use App\Entities\User;
use App\Observers\OrderFowardsObserver;
use App\Observers\PackageObserver;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
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
