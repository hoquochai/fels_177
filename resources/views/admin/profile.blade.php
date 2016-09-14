@extends('admin.master')
@section('title')
    {{ trans('admin_infor/names.profile.title_admin_profile') }}
@endsection
@section('head')
    {{ trans('admin_infor/names.profile.header_panel_profile') }}
@endsection
@section('content')
    @include('admin.error')
    @include('admin.message')
    {{ Form::open(['route' => 'admin.updateProfile', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_name'), trans('admin_infor/names.profile.label_admin_name') . trans('names.required')) }}
        {{ Form::text('name', $admin->name, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_name_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_email'), trans('admin_infor/names.profile.label_admin_email') . trans('names.required')) }}
        {{ Form::email('email', $admin->email, ['class' => 'form-control', 'placeholder' => trans('user/names.placeholder.user_email_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_avatar'), trans('admin_infor/names.profile.label_admin_avatar')) }}
        <img src="{{asset(config('common.user.path.avatar_url') . $admin->avatar)}}" width="100px" height="100px">
    </div>
    <div class="form-group">
        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_avatar_new'), trans('admin_infor/names.profile.label_admin_avatar_new')) }}
        {{ Form::file('avatar') }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_update'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('admin.home') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
    <i>{{ trans('admin_infor/names.profile.label_confirm_change_password') }}</i>
    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#changePassword">
        <span class="glyphicon glyphicon-refresh"></span> {{ trans('admin_infor/names.profile.label_change_password') }}
    </button>

    <!-- Modal change password -->
    <div id="changePassword" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin_infor/names.profile.label_change_password') }}</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route' => 'admin.changePassword', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    <div class="form-group">
                        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_password'), trans('admin_infor/names.profile.label_admin_password') . trans('names.required')) }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('admin_infor/names.profile.placeholder_old_password')]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_password_new'), trans('admin_infor/names.profile.label_admin_password_new') . trans('names.required')) }}
                        {{ Form::password('password_new', ['class' => 'form-control', 'placeholder' => trans('admin_infor/names.profile.placeholder_new_password')]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label(trans('admin_infor/names.profile.label_key_admin_confirm_password'), trans('admin_infor/names.profile.label_admin_confirm_password') . trans('names.required')) }}
                        {{ Form::password('password_new_confirmation', ['class' => 'form-control', 'placeholder' => trans('admin_infor/names.profile.placeholder_confirm_password')]) }}
                    </div>
                    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_update'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
