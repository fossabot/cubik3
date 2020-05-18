const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      screens: {
        dark: {'raw': '(prefers-color-scheme: dark)'},
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
