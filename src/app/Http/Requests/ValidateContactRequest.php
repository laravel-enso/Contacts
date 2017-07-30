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
        $contact = $this->route('contact');

        $emailUnique = Rule::unique('contact_persons', 'email');
        $phoneUnique = Rule::unique('contact_persons', 'phone');

        if ($this->_method == 'PATCH') {
            $emailUnique = $emailUnique->ignore($contact->id);
            $phoneUnique = $phoneUnique->ignore($contact->id);
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
