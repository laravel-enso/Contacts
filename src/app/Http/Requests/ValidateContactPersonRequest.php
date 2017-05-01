<?php

namespace LaravelEnso\ContactPersons\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateContactPersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name'  => 'required|max:50',
            'owner_id'   => 'required|numeric|exists:owners,id',
            'email'      => 'required|email',
            'phone'      => 'required',
        ];
    }
}
