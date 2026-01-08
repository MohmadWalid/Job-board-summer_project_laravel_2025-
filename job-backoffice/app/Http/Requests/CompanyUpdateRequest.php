<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                // Use the Rule::unique() method to ignore the current record's name
                Rule::unique('companies')->ignore($this->route('company')),
            ],
            'address' => 'bail|required|string|max:255',
            'industry' => 'bail|required|string|max:255',
            'website' => 'bail|nullable|string|url|max:255',

            // Owner details
            'owner_name' => 'bail|required|string|max:255',
            'owner_password' => 'bail|nullable|string|min:8|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a string.',
            'name.max' => 'The company name cannot be more than 255 characters.',
            'name.unique' => 'A company with this name already exists.',

            'address.required' => 'The company address is required.',
            'address.string' => 'The company address must be a string.',
            'address.max' => 'The company address cannot be more than 255 characters.',

            'industry.required' => 'The company industry is required.',
            'industry.string' => 'The company industry must be a string.',
            'industry.max' => 'The company industry cannot be more than 255 characters.',

            'website.string' => 'The website must be a string.',
            'website.url' => 'Please enter a valid URL for the website.',
            'website.max' => 'The website URL cannot be more than 255 characters.',

            // Owner name validation messages
            'owner_name.required' => 'The owner\'s name is required.',
            'owner_name.string' => 'The owner\'s name must be a string.',
            'owner_name.max' => 'The owner\'s name may not be greater than 255 characters.',

            // Owner password validation messages
            'owner_password.string' => 'The password must be a string.',
            'owner_password.min' => 'The password must be at least 8 characters long.',
            'owner_password.max' => 'The password must be at most 255 characters long.',
        ];
    }
}
