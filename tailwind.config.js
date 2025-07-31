/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{php,html,js}",
    "./views/**/*.{php,html,js}"
  ],
  theme: {
    extend: {
      colors: {
        'primary-green': '#4CAF50',
        'secondary-green': '#8BC34A',
        'earth-brown': '#795548',
        'light-earth': '#A1887F',
        'sky-blue': '#87CEEB',
        'sand-beige': '#F5DEB3',
      },
    },
  },
  plugins: [],
}