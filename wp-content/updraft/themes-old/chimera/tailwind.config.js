/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./page-templates/**/*.php",
    "./template-parts/**/*.php",
    "./inc/**/*.php",
    "./assets/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        orange: '#FF4A03',
        orangeLight: '#FF8B4D',
        white: '#FFFFFF',
        dark: '#1B1B1B',
        gray: '#666666',
        lightGray: '#E7E7E7',
        offwhite: '#FEFEFE',
        bordergray: '#D9D9D9',
        orangeLightest: '#FF4A031A',
        orangeBorder: '#FF4A0333',
      },
      fontFamily: {
        sans: ['"DM Sans"', 'sans-serif'],
        jost: ['"Jost"', 'sans-serif'],
      },
      animation: {
        marquee: 'marquee 60s linear infinite',
      },
      keyframes: {
        marquee: {
          '0%': { transform: 'translateX(0%)' },
          '100%': { transform: 'translateX(-100%)' },
        }
      },
      backgroundImage: {
        'orange-fade':
          'linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(255,74,3,0.1) 100%)',
      },
    },
  },
  plugins: [],
}
