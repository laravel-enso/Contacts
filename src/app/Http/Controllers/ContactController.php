<?php

namespace LaravelEnso\Contacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\Contacts\app\Http\Requests\ValidateContactRequest;
use LaravelEnso\Contacts\App\Http\Services\ContactService;
use LaravelEnso\Contacts\app\Models\Contact;

class ContactController extends Controller
{
    private $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        return $this->service->list($request);
    }

    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The form has errors',
                'errors'  => $validator->errors()->toArray(),
            ], 422);
        }

        return $this->service->store($request);
    }

    public function update(Request $request, Contact $contact)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The form has errors',
                'errors'  => $validator->errors()->toArray(),
            ], 422);
        }

        return $this->service->update($request, $contact);
    }

    public function destroy(Contact $contact)
    {
        return $this->service->destroy($contact);
    }

    private function validateRequest(Request $request)
    {
        $rules = (new ValidateContactRequest())->rules();
        $validator = \Validator::make($request->get('contact'), $rules);

        return $validator;
    }
}
