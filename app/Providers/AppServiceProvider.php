<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Services\ProjectService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProjectService::class, function ($app) {
        return new \App\Services\ProjectService();
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
