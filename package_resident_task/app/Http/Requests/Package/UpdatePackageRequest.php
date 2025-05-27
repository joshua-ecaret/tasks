<?php

namespace App\Http\Requests\Package;

use App\Rules\CreditRollover;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator;
class UpdatePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


     protected function prepareForValidation()
    {
        $this->merge([
            'apply_credit_rollover' => $this->boolean('apply_credit_rollover'),
        ]);
        if (!$this->boolean('apply_credit_rollover')) {
            $this->merge(['max_rollover_credits' => null]);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {

        return [
            'package_name' => 'sometimes|required|string|max:255',
            'credits' => 'sometimes|required|integer|min:1',
            'credits_time_unit' => 'sometimes|required|in:Per Month,Per Week',
            'status' => 'sometimes|required|in:Active,Inactive,Draft',
            'apply_credit_rollover' => 'required|boolean',
            'max_rollover_credits' => ['nullable', 'integer', 'min:1', 'required_if:apply_credit_rollover,true'],
            'start_date' => ['sometimes', 'date', 'after_or_equal:today', 'date_format:Y-m-d'],
            'end_date' => ['sometimes', 'date', 'after:start_date', 'date_format:Y-m-d',],
        ];
    }

    /**
     * Add casts here
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'apply_credit_rollover' => 'boolean',
            'max_rollover_credits' => 'integer',
            'credits' => 'integer',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $startInput = $this->input('start_date');
            $endInput = $this->input('end_date');


            /** @var \App\Models\Package|null $existing */
            $existing = $this->route('package');
            $start = $startInput ?? optional($existing)->start_date;
            $end = $endInput ?? optional($existing)->end_date;

            if ($start && $end) {
                if (strtotime($start) > strtotime($end)) {
                    if ($startInput && !$endInput) {
                        $validator->errors()->add('start_date', 'Start date must be before or equal to the current end date.');
                    } elseif (!$startInput && $endInput) {
                        $validator->errors()->add('end_date', 'End date must be after or equal to the current start date.');
                    } else {
                        $validator->errors()->add('start_date', 'Start date must be before or equal to end date.');
                    }
                }
            }



        });
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
            'max_rollover_credits.integer' => 'Max rollover credits must be a number.',
            'max_rollover_credits.min' => 'Max rollover credits must be at least 1.',
            'max_rollover_credits.required_unless' => 'You cannot update maximum rollover credits unless credit rollover is enabled ',
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
