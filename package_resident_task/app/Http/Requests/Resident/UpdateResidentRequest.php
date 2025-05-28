<?php

namespace App\Http\Requests\Resident;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation(): void
    {
        $this->merge([
            'is_citizen' => $this->boolean('is_citizen'),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'resident_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' =>
            ['sometimes', 'required', 'email', 'max:255', 'unique:residents,email,' . $this->route('resident')],
            'phone' => ['sometimes', 'nullable', 'string', 'max:20'],
            'package_id' => ['sometimes', 'required', 'exists:packages,id'],
            'status' => ['sometimes', 'nullable', 'string', 'in:Active,Inactive'],
            'is_citizen' => ['sometimes', 'required', 'boolean'],
            'gender' => ['sometimes', 'required', 'string', 'in:Male,Female'],
        ];
    }

    public function messages(): array
    {
        return [
            'resident_name.required' => 'Resident name is required.',
            'resident_name.max' => 'Resident name may not be greater than 255 characters.',

            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email may not be greater than 255 characters.',
            'email.unique' => 'This email is already in use.',

            'phone.max' => 'Phone number may not be greater than 20 characters.',

            'package_id.required' => 'A package selection is required.',
            'package_id.exists' => 'The selected package is invalid.',

            'status.in' => 'Status must be either Active or Inactive.',

            'is_citizen.required' => 'Citizenship status is required.',
            'is_citizen.boolean' => 'Citizenship status must be true or false.',

            'gender.required' => 'Gender is required.',
            'gender.in' => 'Gender must be either Male or Female.',

        ];
    }
}
