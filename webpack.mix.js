const mix = require("laravel-mix");
const TerserPlugin = require("terser-webpack-plugin");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js("resources/js/app.js", "public/js/app.js")
    .js("resources/js/laravel-echo-setup.js", "public/js/laravel-echo-setup.js")
    .js("resources/js/pintura.js", "public/js/pintura.js")
    .css("resources/css/app.css", "public/css/app.css")
    .sourceMaps();
mix.styles(
    ["node_modules/@pqina/pintura/pintura.css"],
    "public/css/pintura.css"
);
if (mix.inProduction()) {
    mix.version();
}
