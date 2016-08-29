@extends('admin.master')
@section('title')
    {{ trans('user/names.title') }}
@endsection
@section('head')
    {{ trans('user/names.header_panel.user.header_panel_edit_user') }}
@endsection
@section('content')
    @include('admin.error')
    {{ Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_name'), trans('user/names.label.user_name') . trans('user/names.required')) }}
        {{ Form::text('name', $value = $user->name, $attributes = ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_name_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_email'), trans('user/names.label.user_email') . trans('user/names.required')) }}
        {{ Form::email('email', $value = $user->email, $attributes = ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_email_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_avatar'), trans('user/names.label.user_avatar') . trans('user/names.required')) }}
        <img src="{{asset(config('common.user.path.avatar_url') . $user->avatar)}}" width="100px" height="100px">
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_avatar_new'), trans('user/names.label.user_avatar_new')) }}
        {{ Form::file('avatar') }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('user/names.button.button_update'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    {{ Form::close() }}
    {{ Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('user/messages.confirm.message_confirm_delete') .'")']) }}
    {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('user/names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger delete']) }}
    <a href="{{ route('user.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('user/names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
@endsection
