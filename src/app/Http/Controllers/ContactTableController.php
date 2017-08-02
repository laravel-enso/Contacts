<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Contacts\app\DataTable\ContactsTableStructure;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\DataTable\app\Traits\DataTable;

class ContactTableController extends Controller
{
    use DataTable;

    protected $tableStructureClass = ContactsTableStructure::class;

    private function getTableQuery()
    {
        return Contact::select(\DB::raw('id as DT_RowId,
            first_name, last_name, phone, email, owner, is_active, obs,
            is_active is_active_bool'));
    }
}
