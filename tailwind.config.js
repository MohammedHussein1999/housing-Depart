/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./src/**/*.{html,js}"
    ],
    theme: {
        extend: {},
    },
    darkMode: "class",
    plugins: [require("tw-elements/plugin.cjs")],
};
