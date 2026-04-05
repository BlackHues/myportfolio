<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactFormRequest extends FormRequest
{
    /** @var string Redirect here when validation fails (contact form anchor). */
    protected $redirect = '/#contact';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $types = array_keys(config('contact.project_types', []));

        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'min:10', 'max:20', 'regex:/^[\d\s+().-]+$/'],
            'project_type' => ['required', Rule::in($types)],
            'message' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please add your name.',
            'phone.required' => 'Add a mobile number so I can reach you.',
            'phone.min' => 'Enter a complete mobile number.',
            'phone.max' => 'That number looks too long.',
            'phone.regex' => 'Use a valid mobile number (digits, optional + for country code).',
            'project_type.required' => 'Choose what kind of site you need.',
        ];
    }
}
