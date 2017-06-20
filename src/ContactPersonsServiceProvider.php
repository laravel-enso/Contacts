<?php

namespace LaravelEnso\ContactPersons;

use Illuminate\Support\ServiceProvider;

class ContactPersonsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/contactpersons');
    }

    public function register()
    {
        //
    }
}
