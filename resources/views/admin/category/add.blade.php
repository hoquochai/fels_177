@extends('admin.master')
@section('title')
	{{ trans('category/names.title') }}
@endsection
@section('head')
	{{ trans('category/names.header_panel.header_panel_add_category') }}
@endsection
@section('content')
	@include('admin.error')
	{{ Form::open(['route' => 'admin.category.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
	<div class="form-group">
		{{ Form::label(trans('category/names.label_key.label_key_name'), trans('category/names.label.category_name') . trans('names.required')) }}
		{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('category/names.placeholder.category_name_placeholder')]) }}
	</div>
	<div class="form-group">
		{{ Form::label(trans('category/names.label_key.label_key_introduction'), trans('category/names.label.category_introduction') . trans('names.required')) }}
		{{ Form::text('introduction', null, ['class' => 'form-control', 'placeholder' => trans('category/names.placeholder.category_introduction_placeholder')]) }}
	</div>
	<div class="form-group">
		{{ Form::label(trans('category/names.label_key.label_key_image'), trans('category/names.label.category_image')) }}
		{{ Form::file('image') }}
	</div>
	{{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_add'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
	<a href="{{ route('admin.category.index') }}">
		<button type="button" class="btn btn-primary">
			<span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
		</button>
	</a>
	{{ Form::close() }}
@endsection
