<?php

namespace App\Http\Requests\Resident;

use Illuminate\Foundation\Http\FormRequest;

class StoreResidentRequest extends FormRequest
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
            'resident_name' => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', 'unique:residents,email'],
            'phone'         => ['nullable', 'string', 'max:20'],
            'package_id'    => ['required', 'exists:packages,id'],

        ];
    }

    public function messages(): array
    {
        return [
            'resident_name.required' => 'Resident name is required.',
            'resident_name.max'      => 'Resident name may not be greater than 255 characters.',

            'email.required'         => 'Email address is required.',
            'email.email'            => 'Please enter a valid email address.',
            'email.max'              => 'Email may not be greater than 255 characters.',
            'email.unique'           => 'This email is already in use.',

            'phone.max'              => 'Phone number may not be greater than 20 characters.',

            'package_id.required'    => 'A package selection is required.',
            'package_id.exists'      => 'The selected package is invalid.',
        ];
    }

}
