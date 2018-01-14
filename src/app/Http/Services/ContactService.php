<?php

namespace LaravelEnso\Contacts\App\Http\Services;

use Illuminate\Http\Request;
use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\FormBuilder\app\Classes\Form;
use LaravelEnso\Contacts\app\Exceptions\ContactException;

class ContactService
{
    public function list(Request $request)
    {
        $contactable = $this->getContactable($request);

        return $contactable->contacts()->get();
    }

    public function store(Request $request)
    {
        $params = (object) $request->get('_params');

        $contact = new Contact($request->all());
        $contact->contactable_id = $params->id;
        $contact->contactable_type = config('enso.contacts.contactables.'.$params->type);

        $contact->save();

        return [
            'message' => __('Created Contact'),
            'redirect' => '',
        ];
    }

    public function update(Request $request, Contact $contact)
    {
        $contact = $contact->update($request->all());

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
        $class = config('enso.contacts.contactables.'.$request->get('type'));

        if (! $class) {
            throw new ContactException(__(
                'Entity ":entity" does not exist in contacts.php config file',
                ['entity' => $request->get('type')]
            ));
        }

        return $class;
    }

    public function getEditForm(Contact $contact)
    {
        $editForm = (new Form($this->getFormPath()))
            ->edit($contact)
            ->title('Edit')
            ->actions(['update', 'destroy'])
            ->get();

        return compact('editForm');
    }

    public function getCreateForm()
    {
        $createForm = (new Form($this->getFormPath()))
            ->create()
            ->title('Insert')
            ->get();

        return compact('createForm');
    }

    private function getFormPath(): string
    {
        return __DIR__.'/../../Forms/contacts/contact.json';
    }
}
