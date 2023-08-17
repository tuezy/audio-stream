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
mix.postCss('resources/css/dashboard.css', 'public/assets/app/dashboard/css', [

    //
]);

mix.postCss('resources/css/app.css', 'public/assets/app/index/css', [

        //
    ]);

mix.copy('resources/js/dashboard/functions.js', 'public/assets/app/dashboard/js/functions.js');