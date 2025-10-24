<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,completed,in_progress'
        ];
    }

    /**
     * Custom error messages for validation rules
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title is required',
            'title.max' => 'The title may not be greater than 255 characters',
            'description.required' => 'The description is required',
            'status.required' => 'The status is required',
            'status.in' => 'The status must be one of the following: pending, completed, in_progress'
        ];
    }
}
