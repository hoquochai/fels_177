@extends('admin.master')
@section('title')
    {{ trans('word/names.title') }}
@endsection
@section('head')
    {{ trans('word/names.header_panel.header_panel_detail_word') }}
@endsection
@section('content')
    @include('admin.error')
    <div class="row">
            {{ trans('word/names.label.category_name') }}: {{ $word->category->name }}<br>
            {{ trans('word/names.label.word_content') }}: {{ $word->content }}<br>
            {{ trans('names.times.create_at_time') }}: {{ $word->created_at }}<br>
            {{ Form::open(['route' => ['word.destroy', $word->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('word/messages.confirm.message_confirm_delete') . '")']) }}
            <a href="{{ route('word.edit', ['id' => $word->id]) }}">
                <button type="button" class="btn btn-warning">
                    <span class="glyphicon glyphicon-pencil"></span> {{ trans('names.button.button_update') }}
                </button>
            </a>
            <a href="{{ route('word.index') }}">
                <button type="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
                </button>
            </a>
            {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger delete']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
