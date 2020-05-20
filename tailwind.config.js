const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.vue',
  ],
  theme: {
    screens: {
      sm: '640px',
      md: '768px',
      dark: {'raw': '(prefers-color-scheme: dark)'},
    },
    extend: {
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
