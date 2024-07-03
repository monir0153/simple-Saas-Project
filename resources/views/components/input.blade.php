@props(['type' => 'text', 'name', 'value' => ''])

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    {{ $attributes->merge(['class' => ' rounded p-2 text-gray-800 dark:bg-gray-900 dark:text-white']) }}
/>