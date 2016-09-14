@extends('admin.master')
@section('title')
    {{ trans('category/names.title') }}
@endsection
@section('head')
    {{ trans('category/names.header_panel.header_panel_detail_category') }}
@endsection
@section('content')
    @include('admin.error')
    <div class="row">
        <div class="col-lg-3">
            <img src="{{ asset(config('common.category.path.image_url') . $category->image) }}" width="200px" height="200px">
        </div>
        <div class="col-lg-9">
            {{ trans('category/names.label.category_name') }}: {{ $category->name }}<br>
            {{ trans('category/names.label.category_introduction') }}: {{ $category->introduction }}<br>
            {{ trans('names.times.create_at_time') }}: {{ $category->created_at }}<br>
            {{ Form::open(['route' => ['admin.category.destroy', $category->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('category/messages.confirm.message_confirm_delete') . '")']) }}
            <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
                <button type="button" class="btn btn-warning">
                    <span class="glyphicon glyphicon-pencil"></span> {{ trans('names.button.button_update') }}
                </button>
            </a>
            <a href="{{ route('admin.category.index') }}">
                <button type="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
                </button>
            </a>
            {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger delete']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
