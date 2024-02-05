let mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/bootstrap.min.js', 'public/js/bootstrap.min.js')
    .css('resources/css/bootstrap.min.css', 'public/css/bootstrap.min.css')
    .sass('resources/sass/app.scss', 'public/css');
/*mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');*/
