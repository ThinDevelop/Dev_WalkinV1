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
require('laravel-mix-polyfill');
 const TargetsPlugin = require('targets-webpack-plugin');
 mix.webpackConfig({
     plugins: [
         new TargetsPlugin({
           browsers: ['last 2 versions', 'chrome >= 41', 'IE 11'],
         }),
       ]
 });

 mix.js('resources/js/app.js', 'public/js')
     .sass('resources/sass/app.scss', 'public/css/app.css')
     .copy('resources/template/dist/assets','public/assets')
     .copy('resources/images','public/images')
     .polyfill({
         enabled: true,
         useBuiltIns: "usage",
         targets: {"ie": 11},
         debug: true,
         corejs: 3,
      });

mix.scripts([
    'resources/template/dist/assets/plugins/global/plugins.bundle.js',
    'resources/template/dist/assets/plugins/custom/prismjs/prismjs.bundle.js',
    'resources/template/dist/assets/js/scripts.bundle.js',
    'resources/template/dist/assets/plugins/custom/datatables/datatables.bundle.js',
    'resources/template/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
    'resources/template/dist/assets/js/pages/widgets.js',
    // 'resources/template/dist/assets/js/pages/crud/ktdatatable/base/data-ajax.js'
], 'public/js/template.js')
.polyfill({
     enabled: true,
     useBuiltIns: "usage",
     targets: {"ie": 11},
     debug: true,
     corejs: 3,
});




// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');
// require('laravel-mix-polyfill');
// if (!mix.inProduction()) {
//     mix.webpackConfig({
//          devtool: 'source-map'
//     }).sourceMaps();
//  } else if (mix.inProduction()) {
//      mix.version();
//  }
//  mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .webpackConfig({
//        module: {
//            rules: [{
//                test: /\.js?$/,
//                exclude: /(node_modules)/,
//                use: [{
//                    loader: 'babel-loader',
//                    options: mix.config.babel()
//                }],
//            }]
//        }
//     })
//   .polyfill({
//      enabled: true,
//      useBuiltIns: "usage",
//      targets: {"firefox": "50", "ie": 11}
//   });
