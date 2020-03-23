const mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');


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

mix.js('resources/js/themes/main.js', 'public/js')
    .js('resources/js/install/setup.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
mix.browserSync('127.0.0.1:8000');
/**
* Publishing the assets
*/
mix.webpackConfig({
   plugins: [
       new WebpackShellPlugin({
           onBuildEnd: [
               'npx workbox injectManifest workbox-config.js'
           ]
       })
   ]
});