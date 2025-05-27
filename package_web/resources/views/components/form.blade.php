@props(['package'])

@php
    $package = $package ?? new \App\Models\Package;
@endphp

<form id="packageForm" class="max-w-xl mx-auto">
    <x-input-floating type="text" name="package_name" label="Package Name"  :value="old('package_name', $package->package_name ?? '')" />
    <div class="grid md:grid-cols-[2fr_1fr] md:gap-6 w-full">
        <x-input-floating type="number" name="credits" label="Credits" 
           :value="old('credits', $package->credits ?? '')" 
        required />
        <x-input-select name="credits_time_unit" label="Credits Time Unit" :options="[
        'Per Month' => 'Per Month',
        'Per Week' => 'Per Week',

    ]" 
        :selected="old('credits_time_unit', $package->credits_time_unit ?? '')"
    :required="true" />
    </div>

    <x-input-select name="status" label="Status" :options="[
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        'Draft' => 'Draft',

    ]" 
       :selected="old('status', $package->status ?? '')" 
    :required="true" />

    <fieldset>
        <legend class="sr-only">Credit Rollover</legend>

        <x-checkbox id="apply_credit_rollover" name="apply_credit_rollover" label="Apply Credit Rollover"
    :checked="old('apply_credit_rollover', $package->apply_credit_rollover ?? false)"
         />

        <div id="rolloverCreditsWrapper">
            <x-input-floating type="number" name="max_rollover_credits" label="Max Rollover Credit"
               :value="old('max_rollover_credits', $package->max_rollover_credits ?? '')" 
            required />
        </div>
    </fieldset>

    <div class="grid md:grid-cols-2 md:gap-6">
        <x-input-date name="start_date" label="Start Date" required min="{{ date('Y-m-d') }}" :value="$package->start_date" />
    
        <x-input-date name="end_date" label="End Date" required min="{{ date('Y-m-d') }}"     :value="$package->end_date"  />
    
    
    </div>
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto
         px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>