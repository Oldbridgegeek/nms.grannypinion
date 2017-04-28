const { mix } = require('laravel-mix');

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

mix.js([
	'resources/assets/js/app.js',
	'resources/assets/js/bootstrap.js',
	'resources/assets/js/plugins/jquery.min.js',
	'resources/assets/js/plugins/bootstrap.min.js',
	// 'resources/assets/js/plugins/rate.min.js'
	], 'public/js');
mix.js('resources/assets/js/feedbacks/feedbacks-app.js', 'public/js');
mix.js('resources/assets/js/surveys/surveys-app.js','public/js');
mix.js('resources/assets/js/chatbox/chatbox-app.js','public/js');
