<?php

namespace LaravelEnso\ContactPersons\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateContactPersonRequest extends FormRequest {

    public function authorize() {

        return true;
    }

    public function rules() {

        return [
            'name'      => 'required|max:50',
            'role_id'   => 'required|numeric|exists:roles,id',
            'owner_id'  => 'required|numeric|exists:owners,id',
            'email'     => 'required|email',
            'telephone' => ['max:20', 'regex:^[0-9+\(\)#\.\s\/ext-]+$^'],
        ];
    }
}
