<?php

namespace App\Api\v1\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $services = [

    ];
    public function register(): void
    {
        foreach ($this->services as $interface => $service) {
            $this->app->bind($interface, $service);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}