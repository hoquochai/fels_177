@extends('admin.master')
@section('title')
    {{ trans('user/names.title') }}
@endsection
@section('head')
    {{ trans('user/names.header_panel.user.header_panel_add_user') }}
@endsection
@section('content')
    @include('admin.error')
    {{ Form::open(['route' => 'admin.user.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_name'), trans('user/names.label.user_name') . trans('names.required')) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_name_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_email'), trans('user/names.label.user_email') . trans('names.required')) }}
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_email_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_password'), trans('user/names.label.user_password') . trans('names.required')) }}
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_password_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_avatar'), trans('user/names.label.user_avatar')) }}
        {{ Form::file('avatar') }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_add'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('admin.user.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
@endsection
