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
                primary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                },
                secondary: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                soft: {
                    bg: '#f8fafc',
                    card: '#ffffff',
                    text: '#1e293b',
                    muted: '#64748b',
                    border: '#e2e8f0',
                    success: '#dcfce7',
                    'success-text': '#166534',
                    error: '#fee2e2',
                    'error-text': '#991b1b',
                    warning: '#fef9c3',
                    'warning-text': '#854d0e',
                    info: '#e0f2fe',
                    'info-text': '#075985',
                }
            },
            boxShadow: {
                'soft': '0 2px 8px 0 rgba(0, 0, 0, 0.04)',
                'card': '0 4px 16px 0 rgba(0, 0, 0, 0.06)',
            }
        },
    },

    plugins: [forms],
};
