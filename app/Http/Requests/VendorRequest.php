<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
                'name' => 'bail|required|unique:categories|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name field must be a string.',
            'name.unique' => 'The name field must be a unique name.',
        ];
    }
}
