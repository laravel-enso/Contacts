<?php

namespace LaravelEnso\ContactPersons;

use Illuminate\Support\ServiceProvider;

class ContactPersonsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/resources/views/' => resource_path('views/vendor/laravel-enso/contactpersons'),
        ], 'contactpersons-views');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/contactpersons');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
