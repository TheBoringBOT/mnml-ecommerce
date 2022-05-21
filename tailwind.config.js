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

                brand: "#141825",
                "brand-hover": "#0e111d",
                black: "#141825",
                "black-2": "#282828",
                grey: "#29292b",
                "off-white": "#f5f5f7",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
