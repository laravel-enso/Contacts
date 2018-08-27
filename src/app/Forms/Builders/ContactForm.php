<?php

namespace LaravelEnso\Contacts\app\Forms\Builders;

use LaravelEnso\Contacts\app\Models\Contact;
use LaravelEnso\FormBuilder\app\Classes\Form;

class ContactForm
{
    private const FormPath = __DIR__.'/../Templates/contact.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::FormPath);
    }

    public function create()
    {
        return $this->form
            ->title('Create')
            ->create();
    }

    public function edit(Contact $contact)
    {
        return $this->form
            ->title('Edit')
            ->actions(['update'])
            ->edit($contact);
    }
}
