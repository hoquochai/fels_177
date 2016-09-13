@extends('admin.master')
@section('title')
    {{ trans('user/names.title') }}
@endsection
@section('head')
    {{ trans('user/names.header_panel.user.header_panel_edit_user') }}
@endsection
@section('content')
    @include('admin.error')
    {{ Form::open(['route' => ['admin.user.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_name'), trans('user/names.label.user_name') . trans('names.required')) }}
        {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_name_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_email'), trans('user/names.label.user_email') . trans('names.required')) }}
        {{ Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_email_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_avatar'), trans('user/names.label.user_avatar')) }}
        <img src="{{asset(config('common.user.path.avatar_url') . $user->avatar)}}" width="100px" height="100px">
    </div>
    <div class="form-group">
        {{ Form::label(trans('user/names.label_key.label_key_avatar_new'), trans('user/names.label.user_avatar_new')) }}
        {{ Form::file('avatar') }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_update'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('admin.user.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
    {{ Form::open(['route' => ['admin.user.destroy', $user->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('user/messages.confirm.message_confirm_delete') . '")']) }}
    <i>{{ trans('user/names.label.label_delete') }}</i>
    {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete']) }}
    {{ Form::close() }}
@endsection
