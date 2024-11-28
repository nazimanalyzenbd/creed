<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TBusinessRequest extends FormRequest
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
            'business_name'             => 'required|string|max:100',
            'business_type_id'          => 'required',
            'business_category_id'      => 'required',
            'business_subcategory_id'   => 'nullable',
            'business_email'            => 'required|email',
            'lat'                       => 'required',
            'long'                      => 'required',
            'business_website'          => 'nullable',
            'address'                   => 'required',
            'country'                   => 'required',
            'state'                     => 'nullable',
            'city'                      => 'required',
            'zip_code'                  => 'required',

        ];
    }

    public function messages(): array
    {
        return [
            'business_name.required'            => 'The business name field is required.',
            'business_type.required'            => 'The business type field is required.',
            'business_category.required'        => 'The business category field is required.',
            'business_email.required'           => 'The business email field is required.',
            'business_email.email'              => 'Please enter a valid email address.',
            'business_phone_number.required'    => 'The phone number field is required.',
            'address.required'                  => 'The address field is required.',
            'country.required'                  => 'The country field is required.',
            'city.required'                     => 'The city field is required.',
            'zip_code.required'                 => 'The zip code field is required.',
        ];
    }
}
