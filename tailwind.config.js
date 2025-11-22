import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    important: true,
    // darkMode: 'class', // We are disabling dark mode as requested

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
            // Define our custom color palette
            colors: {
                'evergreen': {
                    'DEFAULT': '#2F5233',
                    '50': '#EAF7EB',
                    '100': '#D3EED6',
                    '200': '#AADAAF',
                    '300': '#82C889',
                    '400': '#59B663',
                    '500': '#3D9A47',
                    '600': '#2F7837',
                    '700': '#225628',
                    '800': '#15341A',
                    '900': '#08120A',
                    '950': '#040905',
                },
                'ascent': {
                    'blue': '#3B82F6', // Our primary accent blue
                }
            }
        },
    },

    plugins: [forms],
};