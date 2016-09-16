const elixir = require('laravel-elixir');

elixir(function (mix) {
    mix.copy('resources/assets/js/admin/master.js', 'public/js/admin/master.js');
    mix.copy('resources/assets/js/user/lesson.js', 'public/js/user/lesson.js');
    mix.copy('resources/assets/js/user/result.js', 'public/js/user/result.js');
    mix.copy('resources/assets/js/user/word-list.js', 'public/js/user/word-list.js');
    mix.copy('resources/assets/sass/admin/master.scss', 'public/css/admin/master.css');
    mix.copy('resources/assets/sass/login.scss', 'public/css/login.css');
    mix.copy('resources/assets/sass/user/master.scss', 'public/css/user/master.css');
})
