const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                'poppins': ['Poppins'],
                'archivo-narrow': ['Archivo Narrow']
            },
            colors: {
                violet: colors.violet,
                indigo: colors.indigo,
                cyan: colors.cyan,
                emerald: colors.emerald,
                lime: colors.lime,
                amber: colors.amber,
                orange: colors.orange,
                rose: colors.rose,
                teal: colors.teal,
                sky: colors.sky,
                fuchsia: colors.fuchsia,
                blueGray: colors.blueGray,
                'main': '#1B3C41',
                'darker': '#0B282D',
                'lighter': '#428893',
                'subtle': '#BDE2E8',
                'light-4': '#F7F2EF'
            },
            maxHeight: {
                'custom': '90vh',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            scrollbar: ['rounded']
        }
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tailwind-scrollbar'),],
};
