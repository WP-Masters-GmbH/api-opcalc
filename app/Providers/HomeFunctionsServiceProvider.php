<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Commands\PagesFunctions\HomeFunctions;

class HomeFunctionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(HomeFunctions::class, function ($app) {
            return new HomeFunctions();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
