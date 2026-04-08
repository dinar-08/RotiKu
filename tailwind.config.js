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
                'rotiku-utama': '#d97706',  // Warna utama (amber / coklat muda)
                'rotiku-gelap': '#92400e',  // Untuk hover atau variasi warna gelap
                'rotiku-cream': '#fff7ed',  // (Opsional) warna latar belakang roti
            },
        },
    },

    plugins: [forms],
};
