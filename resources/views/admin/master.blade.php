<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ trans('user/names.description_header') }}">
    <meta name="author" content="Ho Quoc Hai">
    <meta name="trainer" content="Nguyen Van Vuong">
    <meta name="trainer" content="Pham Van Doanh">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap theme CSS -->
    <link href="{{ asset('bower/bootstrap/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <!-- Bootstrap datatable CSS -->
    <link href="{{ asset('bower/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- Master CSS -->
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
</head>
<body>

<!-- Menu -->
<div class="row">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">{{ trans('user/names.project') }}</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="{{ $navName === 'home' ? "active" : null }}"><a
                            href="#">{{ trans('user/names.nav_menu.home_menu') }}</a></li>
                <li class="{{ $navName === 'user' ? "active" : null }}"><a
                            href="{{ route('user.index')}}">{{ trans('user/names.nav_menu.user_menu') }}</a></li>
                <li class="{{ $navName === 'category' ? "active" : null }}"><a
                            href="#">{{ trans('user/names.nav_menu.category_menu') }}</a></li>
                <li class="{{ $navName === 'word' ? "active" : null }}"><a
                            href="#">{{ trans('user/names.nav_menu.word_menu') }}</a></li>
                <li class="{{ $navName === 'lesson' ? "active" : null }}"><a
                            href="#">{{ trans('user/names.nav_menu.lesson_menu') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span
                                class="glyphicon glyphicon-user"></span> {{ trans('user/names.nav_menu.admin_menu') }}
                    </a></li>
                <li><a href="#"><span
                                class="glyphicon glyphicon-log-out"></span> {{ trans('user/names.nav_menu.logout_menu') }}
                    </a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- Content -->
<div class="row" id="content">
    <div class="col-lg-10 col-lg-offset-1 panel panel-primary">
        <div class="panel-heading">
            <h2>@yield('head')</h2>
        </div>
        <div class="panel-body">
            @yield('content')
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('/bower/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('/bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- jQuery Datatable JavaScript -->
<script src="{{ asset('/bower/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<!-- Bootstrap Datatable JavaScript -->
<script src="{{ asset('/bower/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- Master JavaScript -->
<script src="{{ asset('/js/admin/master.js') }}"></script>
</body>
</html>
