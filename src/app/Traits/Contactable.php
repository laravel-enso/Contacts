<?php

namespace LaravelEnso\Contacts\app\Traits;

use LaravelEnso\Contacts\app\Models\Contact;

trait Contactable
{
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
