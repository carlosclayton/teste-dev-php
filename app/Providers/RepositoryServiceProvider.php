<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\CarRepository::class, \App\Repositories\CarRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BrandRepository::class, \App\Repositories\BrandRepositoryEloquent::class);
        //:end-bindings:
    }
}
