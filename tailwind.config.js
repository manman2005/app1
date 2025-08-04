/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{php,html,js}",
    "./views/**/*.{php,html,js}"
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#FFFFFF',
        'text-main': '#4E342E',
        'accent': '#4CAF50',
        'accent-light': '#C8E6C9',
        'highlight': '#10B981',
      },
    },
  },
  plugins: [],
}