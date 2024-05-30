/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      colors: {
        primary: "#C72056",
      },
      backgroundImage: (theme) => ({
        "custom-gradient":
          "linear-gradient(180deg, rgba(255, 255, 255, 0.78) 0%, rgba(255, 255, 255, 0.95) 47%, rgba(255, 255, 255, 0.99) 68%, rgba(255, 255, 255, 0.67) 100%)",
      }),
    },
  },
  plugins: [],
};
