<?php

namespace LaravelEnso\Contacts\app\Handlers;

use LaravelEnso\Contacts\app\Models\Contact;

class Collection
{
    private $type;
    private $id;

    public function __construct(string $type, int $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    public function data()
    {
        return Contact::whereContactableType($this->documentable())
            ->whereContactableId($this->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    private function documentable()
    {
        return (new ConfigMapper($this->type))->class();
    }
}
