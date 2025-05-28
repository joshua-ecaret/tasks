@props(['resident', 'validPackages'])

@php
$validPackages = $validPackages ?? \App\Models\Package::all()->pluck('package_name', 'id')->toArray();
$oldGender = old('gender', $resident->gender ?? '');
$isCitizen = old('is_citizen', $resident->is_citizen ?? false);
@endphp

<form id="residentForm" class="mx-auto" style="max-width: 600px;" data-resident-id="{{ $resident->id ?? '' }}">
    <x-input-floating type="text" name="resident_name" label="Resident Name" :value="old('resident_name', $resident->resident_name ?? '')" required />


    <x-input-floating type="email" name="email" label="Email" :value="old('email', $resident->email ?? '')" required />

    <x-input-floating type="text" name="phone" label="Phone (optional)" :value="old('phone', $resident->phone ?? '')" />

    <x-input-select name="package_id" label="Package" :options="$validPackages" :selected="old('package_id', $resident->package_id ?? '')" required />
    <div class="d-flex gap-3 mb-3">
        <x-input-radio name="gender" label="Male" value="Male" :checked="$oldGender === 'Male'" />
        <x-input-radio name="gender" label="Female" value="Female" :checked="$oldGender === 'Female'" />
    </div>
<x-input-select 
    name="status" 
    label="Status" 
    :options="['Active' => 'Active', 'Inactive' => 'Inactive']"
    :selected="old('status', $resident->status?->value ?? '')" 
    required 
/>

    <x-checkbox id="is_citizen" name="is_citizen" label="Australian Citizen" :checked="(bool) $isCitizen" />
    <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100">
            Submit
        </button>
    </div>
</form>