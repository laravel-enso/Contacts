<?php

namespace LaravelEnso\ContactPersons\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateContactPersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $contactPerson = $this->route('contactPerson');

        $emailUnique = Rule::unique('contact_persons', 'email');
        $phoneUnique = Rule::unique('contact_persons', 'phone');

        if ($this->_method == 'PATCH') {
            $emailUnique = $emailUnique->ignore($contactPerson->id);
            $phoneUnique = $phoneUnique->ignore($contactPerson->id);
        }

        return [
            'first_name' => 'required|max:50',
            'last_name'  => 'required|max:50',
            'owner_id'   => 'required|numeric|exists:owners,id',
            'email'      => [
                'email',
                'required',
                $emailUnique,
            ],
            'phone'      => [
                'required',
                $phoneUnique,
            ],
            'is_active' => 'required|in:0,1',
        ];
    }
}
