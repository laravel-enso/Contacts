<?php

namespace LaravelEnso\Contacts;

use Illuminate\Support\ServiceProvider;

class ContactsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/contacts');
    }

    public function register()
    {
        //
    }
}
