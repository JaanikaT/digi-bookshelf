import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                beige:{
                    50: '#faf6f2',
                    100: '#f4ece0',
                    200: '#e8d7c0',
                    300: '#d8bc97',
                    400: '#c89c6f',
                    500: '#bd8452',
                    600: '#af7147',
                    700: '#925a3c',
                    800: '#764a36',
                    900: '#603e2e',
                    950: '#331f17',
                },
            },
        },
    },

    plugins: [forms],
};
