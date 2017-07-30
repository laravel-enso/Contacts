<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\Core\app\Enums\IsActiveEnum;

class ContactsController extends Controller
{
    public function index()
    {
        return view('laravel-enso/contacts::index');
    }

    public function create(Contact $contact)
    {
        $statuses = (new IsActiveEnum())->getData();

        return view('laravel-enso/contacts::create', compact('statuses', 'contact'));
    }

    public function store(ValidateContactRequest $request, Contact $contact)
    {
        $contact = $contact->create($request->all());
        flash()->success(__('The contact person was added!'));

        return redirect('administration/contacts/' . $contact->id . '/edit');
    }

    public function edit(Contact $contact)
    {
        $statuses = (new IsActiveEnum())->getData();

        return view('laravel-enso/contacts::edit', compact('contact', 'statuses'));
    }

    public function update(ValidateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());
        flash()->success(__('The changes have been saved!'));

        return back();
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return ['message' => __('Operation was successful')];
    }
}
