@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 placeholder-gray-400 focus:placeholder-beige-300 dark:placeholder-beige-100 focus:border-beige-300 dark:focus:border-beige-300 focus:ring-beige-300 dark:focus:ring-beige-300 rounded-md shadow-sm']) }}>
