@props([
    'disabled' => false,
    'maxlength' => 500,
    'placeholder' => '',
    'value' => '',
    'name',
    'id' => $name,
])

<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    maxlength="{{ $maxlength }}"
    placeholder="{{ $placeholder }}"
    @disabled($disabled)
    {{ $attributes->merge(['class' =>
        'h-1/2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
        focus:border-beige-300 dark:focus:border-beige-300 focus:ring-beige-300 
        dark:focus:ring-beige-300 rounded-md shadow-sm 
        focus:placeholder-beige-300 placeholder-gray-400'
    ]) }}
></textarea>