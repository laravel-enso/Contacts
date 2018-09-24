<?php

namespace LaravelEnso\Contacts\app\Traits;

use LaravelEnso\Contacts\app\Models\Contact;

trait Contacts
{
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'contactable');
    }
}
