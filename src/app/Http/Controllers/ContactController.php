<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\Contacts\App\Http\Services\ContactService;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\Core\app\Enums\IsActiveEnum;

class ContactController extends Controller
{
    private $contacts;

    public function __construct(Request $request)
    {
        $this->contacts = new ContactService($request);
    }

    public function index()
    {
        return $this->contacts->index();
    }

    public function store()
    {
        $validator = $this->validateRequest();

        if ($validator->fails()) {
            throw new \EnsoException("The form has errors", 'error', $validator->errors()->toArray());
        }

        return $this->contacts->store();
    }

    public function update(Contact $contact)
    {
        $validator = $this->validateRequest();

        if ($validator->fails()) {
            throw new \EnsoException("The form has errors", 'error', $validator->errors()->toArray());
        }

        return $this->contacts->update($contact);
    }

    public function destroy(Contact $contact)
    {
        return $this->contacts->destroy($contact);
    }

    private function validateRequest()
    {
        $rules = (new ValidateContactRequest)->rules();
        $validator = \Validator::make(request()->get('contact'), $rules);

        return $validator;
    }
}
