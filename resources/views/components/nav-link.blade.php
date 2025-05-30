@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-auto bg-beige-300 rounded-md mt-4 dark:border-beige-300 text-lg font-semibold leading-5 text-white dark:text-gray-100 focus:outline-none focus:border-beige-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-auto mt-4 border-b-2 border-transparent text-lg font-semibold leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
