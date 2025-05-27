@props(['name', 'label', 'value' => null, 'required' => false, 'min' => null])

@php
    $value = old($name, $value instanceof \Carbon\Carbon ? $value->format('Y-m-d') : $value);
@endphp

<div class="form-floating mb-3">
    <input
        type="date"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        @if($min) min="{{ $min }}" @endif
        class="form-control"
        placeholder="{{ $label }}"
    />
    <label for="{{ $name }}">{{ $label }}</label>
</div>
