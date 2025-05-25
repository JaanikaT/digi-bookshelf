@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex flex-wrap px-4 py-2 bg-beige-100 dark:bg-beige-300 border-2 border-solid border-beige-300 rounded-md font-semibold text-s text-gray-700 dark:text-white tracking-wide hover:bg-beige-300 dark:hover:bg-gray-600 dark:hover:border-solid dark:hover:border-beige-300 dark:hover:border-2 dark:hover:text-beige-300 dark:focus:bg-white dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-beige-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-auto mt-4 border-b-2 border-transparent text-lg font-semibold leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>