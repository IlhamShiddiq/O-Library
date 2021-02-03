const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/drawer/drawer.js', 'public/js')
    .js('resources/js/aos.js', 'public/js')
    .js('resources/js/btn-landing-page.js', 'public/js')
    .js('resources/js/calendar-setting.js', 'public/js')
    .js('resources/js/checkbox-script.js', 'public/js')
    .js('resources/js/close-message-btn.js', 'public/js')
    .js('resources/js/font-awesome.js', 'public/js')
    .js('resources/js/member-modal.js', 'public/js')
    .js('resources/js/print-pdf.js', 'public/js')
    .js('resources/js/transaction-modal.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/style.scss', 'public/css')
    .sourceMaps();
