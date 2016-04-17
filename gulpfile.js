var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.sass('app.scss')
    mix.styles(['bootstrap.css', 'main.css']);//, 'output',//def public/css 'source'//def resource/assets
	mix.version(['css/all.css']);
	mix.scripts(['vendor/jquery-1.11.2.min.js', 'bootstrap.min.js']);
	mix.phpUnit().phpSpec();
});
