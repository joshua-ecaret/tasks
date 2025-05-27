@props(['package'])

@php
    $package = $package ?? new \App\Models\Package;
@endphp

<form id="packageForm" class="mx-auto" style="max-width: 600px;"
        data-package-id="{{ $package->id ?? '' }}">
    <x-input-floating type="text" name="package_name" label="Package Name"
        :value="old('package_name', $package->package_name ?? '')" />

    <div class="row g-3">
        <div class="col-md-8">
            <x-input-floating type="number" name="credits" label="Credits"
                :value="old('credits', $package->credits ?? '')"
                required />
        </div>
        <div class="col-md-4">
            <x-input-select name="credits_time_unit" label="Credits Time Unit" :options="[
                'Per Month' => 'Per Month',
                'Per Week' => 'Per Week',
            ]"
            :selected="old('credits_time_unit', $package->credits_time_unit ?? '')"
            required />
        </div>
    </div>

    <x-input-select name="status" label="Status" :options="[
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        'Draft' => 'Draft',
    ]"
    :selected="old('status', $package->status ?? '')"
    required />

    <fieldset class="mb-3">
        <legend class="visually-hidden">Credit Rollover</legend>

        <x-checkbox id="apply_credit_rollover" name="apply_credit_rollover" label="Apply Credit Rollover"
            :checked="old('apply_credit_rollover', $package->apply_credit_rollover ?? false)" />

        <div id="rolloverCreditsWrapper">
            <x-input-floating type="number" name="max_rollover_credits" label="Max Rollover Credit"
                :value="old('max_rollover_credits', $package->max_rollover_credits ?? '')"
                required />
        </div>
    </fieldset>

    <div class="row g-3">
        <div class="col-md-6">
            <x-input-date name="start_date" label="Start Date" required min="{{ date('Y-m-d') }}"
                :value="$package->start_date" />
        </div>
        <div class="col-md-6">
            <x-input-date name="end_date" label="End Date" required min="{{ date('Y-m-d') }}"
                :value="$package->end_date" />
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100">
            Submit
        </button>
    </div>
</form>
