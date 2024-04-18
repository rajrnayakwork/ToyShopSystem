<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'vendor' => 'bail|required',
                'name' => 'bail|required|string|regex:/^[a-zA-Z ]+$/u|max:250',
                'sub_categories' => 'bail|array',
                'sub_categories.*.*.name' => 'bail|required|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ];
    }

    public function messages()
    {
        return [
            'vendor.required' => 'The vendor field is required.',
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name field must be a string.',
            'sub_categories.*.required' => 'The sub category field is required.',
            // 'sub_categories.*.regex' => 'The sub category field must be a string.',
        ];
    }
}
