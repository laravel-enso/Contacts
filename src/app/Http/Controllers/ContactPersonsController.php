<?php

namespace LaravelEnso\ContactPersons\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\ContactPersons\app\DataTable\ContactPersonsTableStructure;
use LaravelEnso\ContactPersons\app\Http\Requests\ValidateContactPersonRequest;
use LaravelEnso\ContactPersons\app\Models\ContactPerson;
use LaravelEnso\DataTable\app\Traits\DataTable;
use LaravelEnso\Select\app\Traits\SelectListBuilderTrait;

class ContactPersonsController extends Controller
{
    use DataTable, SelectListBuilderTrait;

    protected $selectSourceClass = ContactPerson::class;
    protected $selectPivotParams = ['owner_id' => 'owners']; //fixme
    protected $tableStructureClass = ContactPersonsTableStructure::class;

    public static function getTableQuery()
    {
        $customParams = json_decode(request('customParams'));
        $ownerId      = $customParams->owner_id;

        $query = ContactPerson::select(\DB::raw('contact_persons.id as DT_RowId, contact_persons.first_name,
            contact_persons.last_name, contact_persons.phone, contact_persons.email, owners.name as owner_name'))
            ->join('owners', 'owners.id', '=', 'contact_persons.owner_id');

        if ($ownerId) {
            $query = $query->where('owner_id', $ownerId);
        }

        return $query;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laravel-enso/contactpersons::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-enso/contactpersons::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateContactPersonRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateContactPersonRequest $request)
    {
        $contactPerson = ContactPerson::create($request->all());
        $contactPerson->save();
        flash()->success(__('The Contact Person was added!'));

        return redirect('administration/contactPersons/' . $contactPerson->id . '/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ContactPerson $contactPerson
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactPerson $contactPerson)
    {
        return view('laravel-enso/contactpersons::edit', compact('contactPerson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|ValidateContactPersonRequest $request
     * @param ContactPerson                        $contactPerson
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateContactPersonRequest $request, ContactPerson $contactPerson)
    {
        $contactPerson->fill($request->all());
        $contactPerson->save();

        flash()->success(__('The Changes have been saved!'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactPerson $contactPerson
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactPerson $contactPerson)
    {
        $contactPerson->delete();

        return [
            'message' => __('Operation was successful'),
        ];
    }

    //fixme
    // public function getOptionsList()
    // {
    //     $ids   = (array) request('selected'); //may be one or more depending on the type of the select
    //     $query = request('query');

    //     $selected = ContactPerson::whereIn('id', $ids)->get();
    //     $entities = ContactPerson::where('name', 'like', '%' . $query . '%')
    //         ->limit(10)->get();

    //     $entities = $entities->merge($selected)->pluck('name', 'id');

    //     $response = [];
    //     foreach ($entities as $key => $value) {
    //         $response[] = [
    //             'key'   => $key,
    //             'value' => $value,
    //         ];
    //     }

    //     return $response;
    // }
}
