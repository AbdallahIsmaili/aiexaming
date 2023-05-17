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
        screens: {
            'sm': {'max': '639px'},

            'md': {'max': '767px'},

            'lg': {'max': '1023px'},

            'xl': {'max': '1279px'},
          },
          fontFamily: {
            'sans': ['Ubuntu', 'Sans-serif']
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {},
    plugins: [
        forms,
        require('tailwindcss-animatecss')({
        settings: {
            animatedSpeed: 1000,
            heartBeatSpeed: 1000,
            hingeSpeed: 2000,
            bounceInSpeed: 750,
            bounceOutSpeed: 750,
            animationDelaySpeed: 1000
        },
        variants: ['responsive'],

        }),
    ],
};
