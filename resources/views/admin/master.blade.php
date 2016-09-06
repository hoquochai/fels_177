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

    <!-- Bootstrap datatable CSS -->
    <link href="{{ asset('bower/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- Master CSS -->
    <link href="{{ asset('css/admin/master.css') }}" rel="stylesheet">
</head>
<body>

<!--Header -->
<div class="row" id="header">
    <h1><img src="{{ asset(config('common.system_path') . config('common.system_images.logo')) }}" width="50px" height="50px"> {{ trans('names.header_admin_page') }}</h1>
</div>
<div class="row">

    <!-- Menu -->
    <div class="col-lg-2">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid" id="menu">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ asset('admin') }}">{{ trans('names.project') }}</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="{{ $navName === 'home' ? "active" : null }}">
                        <a href="{{ asset('admin') }}">{{ trans('names.nav_menu_admin.home_menu') }}</a>
                    </li>
                    <li class="{{ $navName === 'user' ? "active" : null }}">
                        <a href="{{ route('user.index') }}">{{ trans('names.nav_menu_admin.user_menu') }}</a>
                    </li>
                    <li class="{{ $navName === 'category' ? "active" : null }}">
                        <a href="{{ route('category.index') }}">{{ trans('names.nav_menu_admin.category_menu') }}</a>
                    </li>
                    <li class="{{ $navName === 'word' ? "active" : null }}">
                        <a href="{{ route('word.index') }}">{{ trans('names.nav_menu_admin.word_menu') }}</a>
                    </li>
                    <li class="{{ $navName === 'word_answer' ? "active" : null }}">
                        <a href="{{ route('word_answer.index') }}">{{ trans('names.nav_menu_admin.word_answer_menu') }}</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="{{ $navName === 'profile' ? "active" : null }}">
                        <a href="{{ asset('admin/profile') }}">
                            <span class="glyphicon glyphicon-user"></span> {{ trans('names.nav_menu_admin.admin_menu') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('admin/logout') }}">
                            <span class="glyphicon glyphicon-log-out"></span> {{ trans('names.nav_menu_admin.logout_menu') }}
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="col-lg-10">
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
    </div>

    <!-- Footer -->
    <div class="row" id="footer">
        Copyright @ 2016
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
