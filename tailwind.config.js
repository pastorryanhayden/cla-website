module.exports = {
  theme: {
    extend: {}
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms'),
    require('tailwindcss-tables')(),
    require('tailwindcss-plugins/pagination'),
  ]
}
