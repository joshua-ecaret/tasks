@props(['resident','validPackages'])

@php
    $resident = $resident ?? new \App\Models\Resident;
@endphp

<form id="residentForm" class="mx-auto" style="max-width: 600px;" data-resident-id="{{ $resident->id ?? '' }}">
    <x-input-floating
        type="text"
        name="resident_name"
        label="Resident Name"
        :value="old('resident_name', $resident->resident_name ?? '')"
        required
    />

    
    <x-input-floating
        type="email"
        name="email"
        label="Email"
        :value="old('email', $resident->email ?? '')"
        required
    />

    <x-input-floating
        type="text"
        name="phone"
        label="Phone (optional)"
        :value="old('phone', $resident->phone ?? '')"
    />

    <x-input-select
        name="package_id"
        label="Package"
        :options="$validPackages"
        :selected="old('package_id', $resident->package_id ?? '')"
        required
    />

    <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100">
            Submit
        </button>
    </div>
</form>
