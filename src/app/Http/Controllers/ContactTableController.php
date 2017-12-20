<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;

class ContactTableController extends Controller
{
    use Datatable, Excel;

    private const Template = __DIR__.'/../../Tables/contacts.json';

    public function query()
    {
        return Contact::select(\DB::raw('id as dtRowId, first_name, last_name, phone, email, is_active,
        	obs, is_active is_active_bool'));
    }
}
