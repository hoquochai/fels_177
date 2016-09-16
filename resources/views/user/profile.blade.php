@extends('user.master')
@section('title')
	{{ trans('client/profile/names.profile.title_profile_client') }}
@endsection
@section('content')
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-primary" id="result">
			<div class="panel-heading">
				<h1>{{ trans('client/profile/names.profile.heading_panel_profile') }}</h1>
			</div>
			<div class="panel-body">
				@include('admin.error')
				@include('admin.message')
				@if (isset($message))
					<div class="alert alert-info">
						{{ $message }}
					</div>
				@endif
				{{ Form::open(['route' => ['profile.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
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
				<a href="{{ route('home.index') }}">
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
								{{ Form::open(['route' => ['change-password.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
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
			</div>
		</div>
	</div>
@endsection
