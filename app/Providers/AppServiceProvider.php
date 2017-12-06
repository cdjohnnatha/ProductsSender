<?php

namespace App\Providers;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application addons.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application addons.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }

        $this->app->singleton(RepositoryInterface::class, UserRepository::class);
    }
}
