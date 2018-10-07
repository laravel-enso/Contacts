<?php

namespace LaravelEnso\Contacts\app\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Contacts\app\Exceptions\ContactException;

class ValidateContactIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contactable_id' => 'required',
            'contactable_type' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!class_exists($this->contactable_type)
                || !new $this->contactable_type instanceof Model) {
                throw new ContactException(
                    'The "contactable_type" property must be a valid model class'
                );
            }
        });
    }
}
