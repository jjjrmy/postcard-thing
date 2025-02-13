import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        container: {
            center: true,
            padding: "1rem",
        },
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                condensed: ['Open Sans Condensed', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                slab: ['Roboto Slab', 'serif'],
            },
            colors: {
                text: "#0F172A",
                wordmark: "#94A3B8",
                background: "#f1f4f9",
                primary: "#59a2cf",
                secondary: "#e1e8f0",
                tertiary: "#64748b",
                muted: "#CBD5E1",
                dark: "#151c2c", 
                border: "#94A3B8",
            },
            spacing: {
                input: "1.125rem",
            }
        },
    },
    plugins: [],
};
