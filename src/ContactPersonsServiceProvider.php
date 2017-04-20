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
            __DIR__.'/resources/views/contactPersons/' => resource_path('views/vendor/laravel-enso/contactPersons/pages'),
        ], 'contact-persons-views');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/contact-persons');
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
