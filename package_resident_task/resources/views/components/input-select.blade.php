@props(['name', 'label', 'options' => [], 'selected' => null, 'required' => false])

@php
    $selected = old($name, $selected);
@endphp

<div class="form-floating mb-3">
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select"
        {{ $required ? 'required' : '' }}
    >
        @foreach($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
    <label for="{{ $name }}">{{ $label }}</label>

</div>
