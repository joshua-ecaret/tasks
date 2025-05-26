<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePackageRequest extends FormRequest
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
            'package_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
            'credits_time_unit' => 'required|in:Per Month,Per Week',
            'status' => 'required|in:Active,Inactive,Draft',
            'apply_credit_rollover' => 'required|boolean',
            'max_rollover_credits' => 'nullable|integer|min:1|required_if:apply_credit_rollover,true',
            'start_date' => ['required', 'date', 'after_or_equal:today',Rule::date()->format('Y-m-d')],
            'end_date' => ['required', 'date', 'after:start_date',Rule::date()->format('Y-m-d')],
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
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'start_date.before' => 'The start date must be before the end date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after' => 'The end date must be after the start date.',
        ];
    }

}
