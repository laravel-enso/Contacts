<?php

namespace LaravelEnso\Contacts\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->method() === 'GET'
            ? [
                'contactable_id' => 'required',
                'contactable_type' => 'required',
            ]
            : [
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'email' => 'email|nullable',
                'phone' => 'nullable',
                'position' => 'nullable',
                'obs' => 'nullable',
                'is_active' => 'boolean',
            ];
    }
}
