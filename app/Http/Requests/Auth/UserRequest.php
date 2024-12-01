<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'nullable',
            'country' => 'nullable',
            'state' => 'nullable',
            'city' => 'nullable',
            'zip_code' => 'nullable|numeric',
            'status' => 'nullable',
        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = ['required', 'email', 'unique:users,email'];
            $rules['phone_number'] = ['required', 'numeric', 'unique:users,phone_number'];
            $rules['password'] = ['required', 'string', 'min:8'];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = ['required', 'email'];
            $rules['phone_number'] = ['required', 'numeric'];
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'phone_number.required' => 'The phone number field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password at least 8 length.',
        ];
    }
}
