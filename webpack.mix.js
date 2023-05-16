const mix = require("laravel-mix");
const path = require("path");

mix.webpackConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
        },
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: "vue-loader",
                options: {
                    compilerOptions: {
                        isCustomElement: (tag) => /^x-/.test(tag),
                    },
                },
            },
        ],
    },
});

mix.js("resources/js/app.js", "public/js")
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps(); // Adăugați această linie
