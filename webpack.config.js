const path = require("path");

module.exports = {
    resolve: {
        alias: {
            "@": path.resolve("resources/js"),
            "@config": path.resolve("resources/js/themeConfig"),
            "@composables": path.resolve("resources/js/composables"),
        },
    },
};
