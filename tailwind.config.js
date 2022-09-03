const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    prefix: 'tw-',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
        },
        theme: {
            screens: {
                'sm': '576px',
                // => @media (min-width: 576px) { ... }

                'md': '960px',
                // => @media (min-width: 960px) { ... }

                'lg': '1024px',
                // => @media (min-width: 1440px) { ... }
            },
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
