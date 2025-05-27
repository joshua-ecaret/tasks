@props(['id', 'name', 'label', 'checked' => false])

<div class="form-check mb-3">
    <input type="hidden" name="{{ $name }}" value="false" />
    <input
        id="{{ $id }}"
        type="checkbox"
        name="{{ $name }}"
        value="true"
        {{ $checked ? 'checked' : '' }}
        class="form-check-input"
    />
    <label for="{{ $id }}" class="form-check-label">
        {{ $label }}
    </label>
</div>
