const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                brand: "#0000f9",
                "brand-hover": "#2e2eff",
                black: "#1a202c",
                "black-2": "#282828",
                grey: "#7b7b7b",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
