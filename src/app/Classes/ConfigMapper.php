<?php

namespace LaravelEnso\Contacts\app\Classes;

use LaravelEnso\Contacts\app\Exceptions\ContactConfigException;

class ConfigMapper
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function class()
    {
        $contactable = config('enso.contacts.contactables.'.$this->type);

        if (! $contactable) {
            throw new ContactConfigException(__(
                'Entity :entity does not exist in enso/contacts.php config file',
                ['entity' => $this->type]
            ));
        }

        return $contactable;
    }
}
