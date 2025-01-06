/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/components/*.{php,js}',
    './utils/**/.{php,js,html}',
    './index.php',
  ],
  theme: {
    extend: {
      color: {
        jaune :'#FFB703',
      }
    },
  },
  plugins: [],
}