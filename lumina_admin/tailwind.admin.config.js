/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
    "./app/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        navyBg: '#f6f8fc',
        sidebarBg: '#ffffff',
        brandGold: '#f59e0b',
        brandGoldDark: '#d97706',
        brandEmerald: '#059669',
      },
    },
  },
  plugins: [],
}
