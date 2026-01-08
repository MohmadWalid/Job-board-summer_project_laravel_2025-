<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobCategoryUpdateRequest extends FormRequest
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
                Rule::unique('categories')->ignore($this->route('job_category')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The job category name is required.',
            'name.string' => 'The job category name must be a valid string.',
            'name.max' => 'The job category name must not exceed 255 characters.',
            'name.unique' => 'This job category name is already in use.',
        ];
    }
}
