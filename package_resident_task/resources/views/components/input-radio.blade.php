@props([
    'name',
    'label',
    'value',
    'checked' => false,
    'required' => false,
])

@php
    // Check if old input exists, fallback to passed checked prop
    $isChecked = old($name) ? (old($name) == $value) : $checked;
@endphp

<div class="form-check mb-3">
    <input
        class="form-check-input"
        type="radio"
        name="{{ $name }}"
        id="{{ $name . '-' . $value }}"
        value="{{ $value }}"
        {{ $isChecked ? 'checked' : '' }}
        {{ $required ? 'required' : '' }}
    />
    <label class="form-check-label" for="{{ $name . '-' . $value }}">
        {{ $label }}
    </label>
</div>
