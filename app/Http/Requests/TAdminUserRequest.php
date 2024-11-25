<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TAdminUserRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required',
            'country' => 'required',
            'state' => 'nullable',
            'city' => 'required',
            'zip_code' => 'required|numeric',
            'roles' => 'required',
            'status' => 'nullable',
        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = ['required', 'email', 'unique:t_admin_users,email'];
            $rules['phone_number'] = ['required', 'numeric', 'unique:t_admin_users,phone_number'];
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
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'phone_number.required' => 'The phone number field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be 8 length.',
            'address.required' => 'The address field is required.',
            'country.required' => 'The country field is required.',
            'city.required' => 'The city field is required.',
            'zip_code.required' => 'The zip code field is required.',
            'roles.required' => 'The country field is required.',
        ];
    }
}
