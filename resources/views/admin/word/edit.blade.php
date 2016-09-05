@extends('admin.master')
@section('title')
    {{ trans('word/names.title') }}
@endsection
@section('head')
    {{ trans('word/names.header_panel.header_panel_edit_word') }}
@endsection
@section('content')
    @include('admin.error')
    {{ Form::open(['route' => ['word.update', $word->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('word/names.label_key.label_key_name_category'), trans('word/names.label.category_name') . trans('names.required')) }}
        {{ Form::select('category_id', $categories, $word->category->id, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('word/names.label_key.label_key_content'), trans('word/names.label.word_content') . trans('names.required')) }}
        {{ Form::text('content', $word->content, ['class' => 'form-control', 'placeholder' => trans('word/names.placeholder.word_content_placeholder')]) }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_update'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('word.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
    {{ Form::open(['route' => ['word.destroy', $word->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('word/messages.confirm.message_confirm_delete') . '")']) }}
    <i>{{ trans('word/names.label.label_delete_word') }}</i>
    {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete']) }}
    {{ Form::close() }}
@endsection
