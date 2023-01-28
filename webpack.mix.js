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

mix.js('resources/js/dashboard/main.js', 'public/assets/app/dashboard/js')
    .postCss('resources/css/app.css', 'public/assets/app/index/css', [
        //
    ])
    .postCss('resources/css/dashboard.css', 'public/assets/app/dashboard/css', [
    //
]);
