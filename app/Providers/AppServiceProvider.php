<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->applyTimezone();

        // Share app_name with all views
        view()->composer('*', function ($view) {
            $view->with('_appName', app_name());
        });
    }

    /**
     * Override PHP's default timezone with the admin-configured one, so every
     * now()/Carbon call and every timestamp written to the database uses it.
     */
    protected function applyTimezone(): void
    {
        try {
            $timezone = \App\Models\Setting::getValue('timezone');
        } catch (\Exception $e) {
            $timezone = null;
        }

        if ($timezone && in_array($timezone, \DateTimeZone::listIdentifiers(), true)) {
            date_default_timezone_set($timezone);
            config(['app.timezone' => $timezone]);
        }
    }
}
