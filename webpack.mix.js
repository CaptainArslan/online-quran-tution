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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

    mix.combine([
        'front_assets/css/bootstrap.min.css',
        'front_assets/css/bootstrap-grid.min.css',
        'front_assets/css/bootstrap-reboot.min.css',
        'front_assets/css/animate.css',
        'front_assets/css/magnific-popup.css',
        'front_assets/css/jquery.countdown.css',
        'front_assets/css/style.css',
        'front_assets/css/colors/scheme-01.css',
        'front_assets/css/coloring.css',
        'front_assets/css/slick.css',
        'front_assets/css/toastr.min.css'
    ], 'dist/front/css/site.css');




    mix.combine([
        'front_assets/js/wow.min.js',
        'front_assets/js/jquery.min.js',
        'front_assets/js/bootstrap.min.js',
        'front_assets/js/jquery.isotope.min.js',
        'front_assets/js/easing.js',
        'front_assets/js/owl.carousel.js',
        'front_assets/js/validation.js',
        'front_assets/js/jquery.magnific-popup.min.js',
        'front_assets/js/enquire.min.js',
        'front_assets/js/jquery.stellar.min.js',
        'front_assets/js/jquery.plugin.js',
        'front_assets/js/typed.js',
        'front_assets/js/jquery.countTo.js',
        'front_assets/js/jquery.countdown.js',
        'front_assets/js/designesia.js',
        'front_assets/js/slick.js',
        'front_assets/js/toastr.js'
    ], 'dist/front/js/site.js');

