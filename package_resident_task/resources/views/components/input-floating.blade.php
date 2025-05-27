@props(['type' => 'text', 'name', 'label', 'value' => null, 'required' => false])

@php
    $inputValue = old($name, $value);
@endphp

<div class="form-floating mb-3">
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $inputValue }}"
        {{ $required ? 'required' : '' }}
        class="form-control"
        placeholder="{{ $label }}"
    />
    <label for="{{ $name }}">{{ $label }}</label>
</div>
