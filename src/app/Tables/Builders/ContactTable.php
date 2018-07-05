<?php

namespace LaravelEnso\Contacts\app\Tables\Builders;

use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\VueDatatable\app\Classes\Table;

class ContactTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/contacts.json';

    public function query()
    {
        return Contact::select(\DB::raw(
            'id as "dtRowId", first_name, last_name, phone, email,
            position, is_active, is_active as is_active_bool'
        ));
    }
}
