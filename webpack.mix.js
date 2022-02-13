const mix = require("laravel-mix");
const tailwindcss = require('tailwindcss');

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

mix.disableNotifications();

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/livewire-handler.js", "public/js")
    .js("resources/js/calendar.js", "public/js")
    .js("resources/js/editor.js", "public/js")
    .js("resources/js/aos.js", "public/js")
    .js("resources/js/swiper.js", "public/js")
    .js("resources/js/viewer.js", "public/js")
    .js("resources/js/sambat.js", "public/js")
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/chat.scss', 'public/css')
    .sass('resources/sass/animation.scss', 'public/css')
    .sass('resources/sass/announcement.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });

if (mix.inProduction()) {
    mix.version();
}
