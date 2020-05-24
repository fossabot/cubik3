const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('@tailwindcss/ui/colors');

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.vue',
  ],
  theme: {
    screens: {
      sm: '640px',
      md: '768px',
      dark: { 'raw': '(prefers-color-scheme: dark)' },
    },
    extend: {
      colors: {
        // Custom "neutral" gray is very close to default gray palette but has
        // less-saturated colors on the darker end. It is used for dark themes
        // to provide a less blue-feeling UI.
        ngray: {
          50: '#f9fafb',
          100: '#f4f5f7',
          200: '#e5e7ea',
          300: '#d2d6da',
          400: '#a1a6b1',
          500: '#6d7277',
          600: '#4e555c',
          700: '#3a4147',
          800: '#292f35',
          850: '#20262c', // extra color for more flexible bg colors
          900: '#191e23',
        },
      },
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
    },
    container: {
      padding: '1rem',
      center: true,
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ],
};
