<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Contacts\app\DataTable\ContactsTableStructure;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\DataTable\app\Traits\DataTable;

class ContactsTableController extends Controller
{
    use DataTable;

    protected $tableStructureClass = ContactsTableStructure::class;

    private function getTableQuery()
    {
        return Contact::select(\DB::raw('contact_persons.id as DT_RowId,
            contact_persons.first_name, contact_persons.last_name, contact_persons.phone,
            contact_persons.email, owners.name as owner_name, contact_persons.is_active'))
            ->join('owners', 'owners.id', '=', 'contact_persons.owner_id');
    }
}
