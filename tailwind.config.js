const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: ["./resources/js/**/*.{vue,js}"],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("tailwind-scrollbar"),
        require("@tailwindcss/typography"),
    ],
    variants: {
        scrollbar: ["rounded"],
    },
};
