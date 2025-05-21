<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'package_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
            'credits_time_unit' => 'required|in:Per Month,Per Week',
            'status' => 'required|in:Active,Inactive,Draft',
            'apply_credit_rollover' => 'required|boolean',
            'max_rollover_credits' => 'nullable|integer|min:1|required_if:apply_credit_rollover,true',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'package_name.required' => 'Package name is required.',
            'credits.required' => 'Credits are required.',
            'credits.integer' => 'Credits must be a number.',
            'credits.min' => 'Credits must be at least 1.',
            'credits_time_unit.required' => 'Credit time unit is required.',
            'credits_time_unit.in' => 'Credit time unit must be either "Per Month" or "Per Week".',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be Active, Inactive, or Draft.',
            'apply_credit_rollover.required' => 'Please specify if credit rollover is applied.',
            'apply_credit_rollover.boolean' => 'Rollover field must be true or false.',
            'max_rollover_credits.required_if' => 'Max rollover credits are required when rollover is applied.',
            'max_rollover_credits.integer' => 'Max rollover credits must be a number.',
            'max_rollover_credits.min' => 'Max rollover credits must be at least 1.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'credits_time_unit' => 'credit time unit',
            'apply_credit_rollover' => 'apply credit rollover',
            'max_rollover_credits' => 'maximum rollover credits',
        ];
    }
}

