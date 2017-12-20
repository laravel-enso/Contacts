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
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'email|nullable',
            'phone' => 'nullable',
        ];
    }
}
