<?php

namespace LaravelEnso\ContactPersons\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\ContactPersons\app\DataTable\ContactPersonsTableStructure;
use LaravelEnso\ContactPersons\app\Http\Requests\ValidateContactPersonRequest;
use LaravelEnso\ContactPersons\app\Models\ContactPerson;
use LaravelEnso\Core\app\Enums\IsActiveEnum;
use LaravelEnso\DataTable\app\Traits\DataTable;

class ContactPersonController extends Controller
{
    use DataTable;

    protected $tableStructureClass = ContactPersonsTableStructure::class;

    public static function getTableQuery()
    {
        $query = ContactPerson::select(\DB::raw('contact_persons.id as DT_RowId,
            contact_persons.first_name, contact_persons.last_name, contact_persons.phone,
            contact_persons.email, owners.name as owner_namea, contact_persons.is_active'))
            ->join('owners', 'owners.id', '=', 'contact_persons.owner_id');

        return $query;
    }

    public function index()
    {
        return view('laravel-enso/contactpersons::index');
    }

    public function create()
    {
        $statuses = (new IsActiveEnum())->getData();

        return view('laravel-enso/contactpersons::create', compact('statuses'));
    }

    public function store(ValidateContactPersonRequest $request, ContactPerson $contactPerson)
    {
        $contactPerson = $contactPerson->create($request->all());
        flash()->success(__('The Contact Person was added!'));

        return redirect('administration/contactPersons/'.$contactPerson->id.'/edit');
    }

    public function edit(ContactPerson $contactPerson)
    {
        $statuses = (new IsActiveEnum())->getData();

        return view('laravel-enso/contactpersons::edit', compact('contactPerson', 'statuses'));
    }

    public function update(ValidateContactPersonRequest $request, ContactPerson $contactPerson)
    {
        $contactPerson->update($request->all());
        flash()->success(__('The Changes have been saved!'));

        return back();
    }

    public function destroy(ContactPerson $contactPerson)
    {
        $contactPerson->delete();

        return ['message' => __('Operation was successful')];
    }
}
