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

mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/category.js', 'public/js');

mix.sass('resources/scss/app.scss', 'public/css/app.css');
mix.sass('resources/scss/auth.scss', 'public/css/auth.css');
mix.sass('resources/scss/category.scss', 'public/css/category.css');

if (mix.inProduction()) {
    mix.version();
}

mix.browserSync('localhost:8000');
