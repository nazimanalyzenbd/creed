<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TCompanyInfoRequest extends FormRequest
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
            'system_name' => 'required|string',
            'owner_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            // 'logo' => 'required|image|mimes:jpg,png,jpeg,gif',
            // 'favicon_icon' => 'required|image|mimes:jpg,png,jpeg,gif',
            'business_identification_no' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'zip_code' => 'nullable|numeric',
            'website_link' => 'nullable',
            'facebook_id' => 'nullable',
            'linkedIn_id' => 'nullable',
            'youtube_link' => 'nullable',
            'status' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'system_name.required' => 'The System/Company name field is required.',
            'owner_name.required' => 'The Owner name field is required.',
            'email.required' => 'The email field is required.',
            'phone_number.required' => 'The phone number field is required.',
        ];
    }
}
