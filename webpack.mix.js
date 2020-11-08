const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/font-awesome.js', 'public/js')
    .js('resources/js/member-modal.js', 'public/js')
    .js('resources/js/transaction-modal.js', 'public/js')
    .js('resources/js/btn-landing-page.js', 'public/js')
    .js('resources/js/close-message-btn.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css/')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));
