<?php

namespace LaravelEnso\Contacts\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $emailUnique = Rule::unique('contacts', 'email');
        $phoneUnique = Rule::unique('contacts', 'phone');

        if (request()->getMethod() == 'PATCH') {
            $emailUnique = $emailUnique->ignore(request()->get('contact')['id']);
            $phoneUnique = $phoneUnique->ignore(request()->get('contact')['id']);
        }

        return [
            'first_name' => 'required|max:50',
            'last_name'  => 'required|max:50',
            'email'      => [
                'email',
                'nullable',
                $emailUnique,
            ],
            'phone'      => [
                'nullable',
                $phoneUnique,
            ],
        ];
    }
}
