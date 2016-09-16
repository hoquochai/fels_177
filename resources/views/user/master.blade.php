<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ trans('names.description_header') }}">
    <meta name="author" content="Ho Quoc Hai">
    <meta name="trainer" content="Nguyen Van Vuong">
    <meta name="trainer" content="Pham Van Doanh">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap theme CSS -->
    <link href="{{ asset('bower/bootstrap/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <!-- Master CSS -->
    <link href="{{ asset('css/user/master.css') }}" rel="stylesheet">
</head>
<body>

<!--Menu-->
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <p><img src="{{ asset(config('common.system_path') . config('common.system_images.logo')) }}"
                        width="30px" height="30px"> {{ trans('names.project') }}</p>
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li class="{{ $navName === 'home' ? "active" : null }}"><a href="{{ route('home.index') }}">{{ trans('names.nav_menu_admin.home_menu') }}</a></li>
            <li class="{{ $navName === 'category' ? "active" : null }}"><a href="{{ route('category.index') }}">{{ trans('names.nav_menu_admin.category_menu') }}</a></li>
            <li class="{{ $navName === 'word' ? "active" : null }}"><a href="{{ route('word.index') }}">{{ trans('names.nav_menu_admin.word_menu') }}</a></li>
            <li class="{{ $navName === 'result' ? "active" : null }}"><a href="{{ route('result.index') }}">{{ trans('names.nav_menu_user.result_menu') }}</a></li>
            <li class="{{ $navName === 'profile' ? "active" : null }}"><a href="{{ route('profile.index') }}">{{ trans('names.nav_menu_admin.profile_menu') }}</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('profile.index') }}"><span class="glyphicon glyphicon-user"></span> {{ $user->name }}</a></li>
            <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> {{ trans('names.nav_menu_admin.logout_menu') }}</a></li>
        </ul>
    </div>
</nav>

<!--Content-->
<div class="container-fluid">
    @include('admin.error');
    <div class="col-lg-9">
        <div class="row" id="content">
            @yield('content')
        </div>
    </div>
    <div class="col-lg-3">
        @include('user.list-user')
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('/bower/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('/bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Lesson JavaScript -->
<script src="{{ asset('/js/user/lesson.js') }}"></script>

<!-- Word list JavaScript -->
<script src="{{ asset('/js/user/word-list.js') }}"></script>
</body>
</html>
