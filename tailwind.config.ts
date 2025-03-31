import type { Config } from "tailwindcss";

const config: Config = {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    fontFamily: {
      sans: ["Open Sans", "sans-serif"],
    },
    extend: {
      colors: {
        "primary-green": "rgb(var(--primary-green) / <alpha-value>)",
        "primary-beige": "rgb(var(--primary-beige) / <alpha-value>)",
        "off-white": "rgb(var(--off-white) / <alpha-value>)",
        "off-black": "rgb(var(--off-black) / <alpha-value>)",
      },
      fontFamily: {
        "open-sans": ["Open Sans", "sans-serif"],
        merriweather: ["Merriweather", "serif"],
        "merriweather-sans": ["Merriweather", "sans-serif"],
      },
    },
  },
  plugins: [],
};

export default config;