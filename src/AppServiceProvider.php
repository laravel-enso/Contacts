<?php

namespace LaravelEnso\Contacts;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Contacts\app\Commands\DropCreatedBy;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            DropCreatedBy::class,
        ]);

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'contacts-config');

        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'enso-config');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'contacts-assets');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'enso-assets');
    }

    public function register()
    {
        //
    }
}
