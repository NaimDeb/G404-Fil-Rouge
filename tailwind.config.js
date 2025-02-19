/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/*.php',
    './public/**/*.php',
    './process/*.php',
    './src/**/*.php',
    './public/assets/scripts/*.js',
    './index.php',
  ],
  theme: {
    fontFamily: {
      "sans" : ["Open Sans", "sans-serif"]
    },
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
        merriweather : ["Merriweather", "serif"],
        "merriweather-sans" : ["Merriweather", "sans-serif"]
      }
    },
  },
  plugins: [],
}