<?php

namespace LaravelEnso\Contacts\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\Contacts\app\Tables\Builders\ContactTable;

class ContactTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = ContactTable::class;
}
