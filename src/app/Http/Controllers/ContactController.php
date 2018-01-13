<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\Contacts\App\Http\Services\ContactService;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;

class ContactController extends Controller
{
    private $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }

    public function getCreateForm()
    {
        return $this->service->getCreateForm();
    }

    public function getEditForm(Contact $contact)
    {
        return $this->service->getEditForm($contact);
    }

    public function list(Request $request)
    {
        return $this->service->list($request);
    }

    public function store(ValidateContactRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(ValidateContactRequest $request, Contact $contact)
    {
        return $this->service->update($request, $contact);
    }

    public function destroy(Contact $contact)
    {
        return $this->service->destroy($contact);
    }
}
