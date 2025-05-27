@props(['id', 'name', 'label', 'checked' => false])

<div class="flex items-center mb-4">
    <input type="hidden" name="{{ $name }}" value="false" />
    <input
        id="{{ $id }}"
        type="checkbox"
        name="{{ $name }}"
        value="true"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'w-4 h-4 text-blue-600 ...']) }}
    />
    <label for="{{ $id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
        {{ $label }}
    </label>
</div>
