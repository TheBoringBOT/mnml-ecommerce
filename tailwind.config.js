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
                // brand: "#0000f9",
                // "brand-hover": "#2e2eff",

                brand: "#282828",
                "brand-hover": "#383838",
                black: "#282828",
                "black-2": "#282828",
                grey: "#777",
                "off-white": "#eee",
                skeleton: "#e8e9eb",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
