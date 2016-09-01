@extends('admin.master')
@section('title')
    {{ trans('category/names.title') }}
@endsection
@section('head')
    {{ trans('category/names.header_panel.header_panel_edit_category') }}
@endsection
@section('content')
    @include('admin.error')
    {{ Form::open(['route' => ['category.update', $category->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('category/names.label_key.label_key_name'), trans('category/names.label.category_name') . trans('names.required')) }}
        {{ Form::text('name',  $category->name, ['class' => 'form-control', 'placeholder' => trans('category/names.placeholder.category_name_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('category/names.label_key.label_key_introduction'), trans('category/names.label.category_introduction') . trans('names.required')) }}
        {{ Form::text('introduction', $category->introduction, ['class' => 'form-control', 'placeholder' => trans('category/names.placeholder.category_introduction_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('category/names.label_key.label_key_image'), trans('category/names.label.category_image')) }}
        <img src="{{asset(config('common.category.path.image_url') . $category->image)}}" width="100px" height="100px">
    </div>
    <div class="form-group">
        {{ Form::label(trans('category/names.label_key.label_key_image_new'), trans('category/names.label.category_image_new')) }}
        {{ Form::file('image') }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_add'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('category.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
    {{ Form::open(['route' => ['category.destroy', $category->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('category/messages.confirm.message_confirm_delete') . '")']) }}
    <i>{{ trans('category/names.label.label_delete_category') }}</i>
    {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete']) }}
    {{ Form::close() }}
@endsection
