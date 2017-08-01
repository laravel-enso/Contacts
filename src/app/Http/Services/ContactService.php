<?php

namespace LaravelEnso\Contacts\App\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\Contacts\app\Models\Contact;

class ContactService
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $contactable = $this->getContactable();

        return $contactable->contacts()->get();
    }

    public function store()
    {
        $contactable = $this->getContactable();
        $contact = new Contact($this->request->get('contact'));
        $contact->owner = $contactable->name;
        $contactable->contacts()->save($contact);

        return $contact->fresh();
    }

    public function update(Contact $contact)
    {
        $contact = $contact->update($this->request->get('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return ['message' => __(config('labels.successfulOperation'))];
    }

    private function getContactable()
    {
        return $this->getContactableClass()::find($this->request['id']);
    }

    private function getContactableClass()
    {
        $class = config('contacts.contactables.' . $this->request['type']);

        if (!$class) {
            throw new \EnsoException(
                __('Current entity does not exist in contacts.php config file: ') . $this->request['type']
            );
        }

        return $class;
    }
}
