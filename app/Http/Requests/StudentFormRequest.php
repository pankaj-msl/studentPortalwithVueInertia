<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:students,email','max:255'],
            'class_id' => ['required','exists:classes,id'],
            'section_id' => ['required','exists:sections,id'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Student Name',
            'email' => 'Student Email',
            'class_id' => 'Class',
           'section_id' => 'Section',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute field must be a string.',
            'name.max' => 'The :attribute field must be less than or equal to 255 characters.',
            'email.required' => 'The :attribute field is required.',
            'email.email' => 'The :attribute field must be a valid email address.',
            'email.unique' => 'The :attribute has already been taken.',
            'email.max' => 'The :attribute field must be less than or equal to 255 characters.',
            'class_id.required' => 'The :attribute field is required.',
            'class_id.exists' => 'The selected :attribute is invalid.',
           'section_id.required' => 'The :attribute field is required.',
           'section_id.exists' => 'The selected :attribute is invalid.',
        ];
    }
}
