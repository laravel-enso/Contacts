<?php

namespace LaravelEnso\Contacts\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'isActive' => $this->is_active,
        ];
    }
}
