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
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            white: '#ffffff',
            purple: '#3f3cbb',
            midnight: '#121063',
            metal: '#565584',
            tahiti: '#3ab7bf',
            silver: '#ecebff',
            'bubble-gum': '#ff77e9',
            bermuda: '#78dcca',
            lavender: '#c6b2ff',
            moss: '#9bcf8a',
            rose: '#ff9baf',
            sunshine: '#ffdb6d',
            navy: '#001f3f',
            lime: '#00ff00',
            red: '#ff0000',
            orange: '#ff6600',
            blue: '#0000ff',
            green: '#008000',
            pink: '#ff69b4',
            // Add more colors here
        },
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
