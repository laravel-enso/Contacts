<?php

namespace LaravelEnso\Contacts\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Contacts\app\Exceptions\ContactException;

class ValidateContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'contactable_id' => 'required',
            'contactable_type' => 'required',
        ];

        return $this->method() === 'GET'
            ? $rules
            : $rules + [
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'email' => 'email|nullable',
                'phone' => 'nullable',
                'position' => 'nullable',
                'obs' => 'nullable',
                'is_active' => 'boolean',
            ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (! class_exists($this->contactable_type)) {
                throw new ContactException(
                    'The "contactable_type" property must be a valid model class'
                );
            }
        });
    }
}
