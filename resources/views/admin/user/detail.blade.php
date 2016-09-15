@extends('admin.master')
@section('title')
    {{ trans('user/names.title') }}
@endsection
@section('head')
    {{ trans('user/names.header_panel.user.header_panel_detail_user') }}
@endsection
@section('content')
    @include('admin.error')
    <div class="row">
        <div class="col-lg-3">
            <img src="{{ asset(config('common.user.path.avatar_url') . $user->avatar) }}" width="200px" height="200px">
        </div>
        <div class="col-lg-9">
            {{ trans('user/names.label.user_name') }}: {{ $user->name }}<br>
            {{ trans('user/names.label.user_email') }}: {{ $user->email }}<br>
            {{ trans('names.times.create_at_time') }}: {{ $user->created_at }}<br>
            {{ Form::open(['route' => ['admin.user.destroy', $user->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('user/messages.confirm.message_confirm_delete') . '")']) }}
            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}">
                <button type="button" class="btn btn-warning">
                    <span class="glyphicon glyphicon-pencil"></span> {{ trans('names.button.button_update') }}
                </button>
            </a>
            <a href="{{ route('admin.user.index') }}">
                <button type="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
                </button>
            </a>
            {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger delete']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
