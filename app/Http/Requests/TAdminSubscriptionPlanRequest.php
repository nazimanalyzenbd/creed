<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TAdminSubscriptionPlanRequest extends FormRequest
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
            'plan_name' => 'required|string',
            'country_id' => 'required|string',
            'monthly_cost' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'yearly_cost' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'plan_name.required' => 'The name field is required.',
            'country_id.required' => 'The country name field is required.',
            'monthly_cost.required' => 'The monthly cost field is required.',
            'yearly_cost.required' => 'The yearly cost field is required.',
        ];
    }
}
