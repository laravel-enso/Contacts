<?php

namespace LaravelEnso\Contacts\App\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\Contacts\app\Models\Contact;

class ContactService
{
    public function list(Request $request)
    {
        $contactable = $this->getContactable($request);

        return $contactable->contacts()->get();
    }

    public function store(Request $request)
    {
        $contactable = $this->getContactable($request);
        $contact = new Contact($request->get('contact'));
        $contactable->contacts()->save($contact);

        return $contact->fresh();
    }

    public function update(Request $request, Contact $contact)
    {
        $contact = $contact->update($request->get('contact'));

        return ['message' => __(config('enso.labels.successfulOperation'))];
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return ['message' => __(config('enso.labels.successfulOperation'))];
    }

    private function getContactable(Request $request)
    {
        return $this->getContactableClass($request)::find($request->get('id'));
    }

    private function getContactableClass(Request $request)
    {
        $class = config('enso.contacts.contactables.' . $request->get('type'));

        if (!$class) {
            throw new \EnsoException(
                __('Current entity does not exist in contacts.php config file') . ': ' . $request->get('type')
            );
        }

        return $class;
    }
}
