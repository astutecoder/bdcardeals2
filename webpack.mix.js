let mix = require('laravel-mix');
require('laravel-mix-react-css-modules');


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

mix.react('resources/js/app.js', 'public/js/app.js')
    .react('resources/js/backend.js', 'public/js/backend.js')
    .react('resources/js/frontend.js', 'public/js/frontend.js')
    .reactCSSModules('[name]__[local]___[hash:base64]')
   .sass('resources/sass/app.scss', 'public/css/app.css');
