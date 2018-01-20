<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\Contacts\app\Forms\Builders\ContactForm;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return $this->service->list($request);
    }

    public function create(ContactForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateContactRequest $request, Contact $contact)
    {
        $contact->store($request->all(), $request->get('_params'));

        return ['message' => __('Created Contact')];
    }

    public function edit(Contact $contact, ContactForm $form)
    {
        return ['form' => $form->edit($contact)];
    }

    public function update(ValidateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return ['message' => __(config('enso.labels.successfulOperation'))];
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return ['message' => __(config('enso.labels.successfulOperation'))];
    }
}
