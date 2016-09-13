@extends('admin.master')
@section('title')
    {{ trans('admin_infor/names.home.title_admin_home') }}
@endsection
@section('head')
    {{ trans('admin_infor/names.home.header_panel_home') }}
@endsection
@section('content')
    <div class="row component">
        <div class="col-lg-6">
            <a href="{{ route('admin.user.index') }}">
                <button type="button" class="btn btn-success btn-block">
                    <h2><span class="glyphicon glyphicon-user"></span> {{ trans('names.nav_menu_admin.user_menu') }}</h2>
                    <i>{{ trans('admin_infor/names.home.statistics.statistics_users') }}: {{ $numberOfUsers }}</i>
                </button>
            </a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('admin.category.index') }}">
                <button type="button" class="btn btn-success btn-block">
                    <h2><span class="glyphicon glyphicon-menu-hamburger"></span> {{ trans('names.nav_menu_admin.category_menu') }}</h2>
                    <i>{{ trans('admin_infor/names.home.statistics.statistics_categories') }}: {{ $numberOfCategories }}</i>
                </button>
            </a>
        </div>
    </div>
    <div class="row component">
        <div class="col-lg-6">
            <a href="{{ route('admin.word.index') }}">
                <button type="button" class="btn btn-success btn-block">
                    <h2><span class="glyphicon glyphicon-duplicate"></span> {{ trans('names.nav_menu_admin.word_menu') }}</h2>
                    <i>{{ trans('admin_infor/names.home.statistics.statistics_words') }}: {{ $numberOfWords }}</i>
                </button>
            </a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('admin.word_answer.index') }}">
                <button type="button" class="btn btn-success btn-block">
                    <h2><span class="glyphicon glyphicon-duplicate"></span> {{ trans('names.nav_menu_admin.word_answer_menu') }}</h2>
                    <i>{{ trans('admin_infor/names.home.statistics.statistics_word_answers') }}: {{ $numberOfWordAnswers }}</i>
                </button>
            </a>
        </div>
    </div>
    <div class="row component">
        <div class="col-lg-6">
            <a href="{{ route('admin.profile') }}">
                <button type="button" class="btn btn-success btn-block">
                    <h2><span class="glyphicon glyphicon-list-alt"></span> {{ trans('names.nav_menu_admin.profile_menu') }}</h2>
                </button>
            </a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('logout') }}">
                <button type="button" class="btn btn-success btn-block">
                    <h2><span class="glyphicon glyphicon-log-out"></span> {{ trans('names.nav_menu_admin.logout_menu') }}</h2>
                </button>
            </a>
        </div>
    </div>
@endsection