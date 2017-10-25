<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;
use LaravelEnso\Contacts\App\Http\Services\ContactService;
use LaravelEnso\Contacts\app\Models\Contact;

class ContactController extends Controller
{
    private $contacts;

    public function __construct(Request $request)
    {
        $this->contacts = new ContactService($request);
    }

    public function index()
    {
        return view('laravel-enso/contacts::index');
    }

    function list() {
        return $this->contacts->list();
    }

    public function store()
    {
        $validator = $this->validateRequest();

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->contacts->store();
    }

    public function update(Contact $contact)
    {
        $validator = $this->validateRequest();

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->contacts->update($contact);
    }

    public function destroy(Contact $contact)
    {
        return $this->contacts->destroy($contact);
    }

    private function validateRequest()
    {
        $rules     = (new ValidateContactRequest())->rules();
        $validator = \Validator::make(request()->get('contact'), $rules);

        return $validator;
    }
}
