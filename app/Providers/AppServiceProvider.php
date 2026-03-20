<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share app_name with all views
        view()->composer('*', function ($view) {
            $view->with('_appName', app_name());
        });
    }
}
