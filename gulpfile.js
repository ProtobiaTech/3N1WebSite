var gulp = require('gulp');
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.registerWatcher('default', ['resources/assets/sass/*', 'resources/assets/*/*']);

elixir(function(mix) {
    mix.sass('bootstrap.scss', 'public/assets/style/style.css');
});
