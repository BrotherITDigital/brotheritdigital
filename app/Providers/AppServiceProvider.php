<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (\Schema::hasTable('site_settings')) {
                $settings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
                view()->share('settings', $settings);
            }
        } catch (\Throwable $e) {
            // Fail silently if database is not set up yet
        }
    }
}
