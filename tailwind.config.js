/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/**/*.php',
    './index.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
            green: "rgb(74, 124, 89)",
            beige: "rgb(250, 243, 221)"
        },
        neutral: {
            "off-white": "rgb(247, 247, 247)",
            "off-black": "rgb(40, 40, 40)"
        }
      },
      fontFamily: {
        "open-sans" : ["Open Sans", "sans-serif"],
        Merriweather : ["Merriweather", "serif"],
        "Merriweather-sans-serif" : ["Merriweather", "sans-serif"]
      }
    },
  },
  plugins: [],
}