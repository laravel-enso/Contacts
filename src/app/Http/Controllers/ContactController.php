<?php

namespace LaravelEnso\Contacts\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\Contacts\app\Forms\Builders\ContactForm;
use LaravelEnso\Contacts\app\Http\Resources\Contact as Resource;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;

class ContactController extends Controller
{
    public function index(ValidateContactRequest $request)
    {
        return Resource::collection(
            Contact::ordered()
                ->for($request->validated())
                ->ordered()
                ->get()
        );
    }

    public function create(ContactForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateContactRequest $request)
    {
        Contact::create($request->validated());

        return [
            'message' => __('The contact was created successfully'),
        ];
    }

    public function edit(Contact $contact, ContactForm $form)
    {
        return ['form' => $form->edit($contact)];
    }

    public function update(ValidateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return [
            'message' => __('The contact was updated successfully'),
        ];
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return [
            'message' => __('The contact was deleted successfully'),
        ];
    }
}
