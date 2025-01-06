<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TBusinessOwnerInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email',
            'country_code'  => 'nullable',
            'phone_number'  => 'required|max:15',
            'address'       => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required'   => 'The first name field is required.',
            'last_name.required'    => 'The last name field is required.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'Please enter a valid email address.',
            'phone_number.required' => 'The phone number field is required.',
            'address.required'      => 'The address field is required.',
        ];
    }
}
