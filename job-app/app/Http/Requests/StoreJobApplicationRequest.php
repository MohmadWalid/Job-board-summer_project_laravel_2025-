<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'resume_option' => 'required|in:existing,new',
            'existing_resume_id' => 'required_if:resume_option,existing|nullable|exists:resumes,id',
            'resume' => 'required_if:resume_option,new|nullable|file|mimes:pdf|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'resume.required_if' => 'Please upload a PDF resume.',
            'resume.mimes' => 'Resume must be a PDF file.',
            'resume.max' => 'Resume must not exceed 5MB.',
            'existing_resume_id.required_if' => 'Please select a resume.',
            'existing_resume_id.exists' => 'The selected resume is invalid.',
        ];
    }
}
