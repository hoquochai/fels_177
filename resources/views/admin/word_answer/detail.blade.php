@extends('admin.master')
@section('title')
    {{ trans('word_answer/names.title') }}
@endsection
@section('head')
    {{ trans('word_answer/names.header_panel.header_panel_detail_word_answer') }}
@endsection
@section('content')
    @include('admin.error')
    <div class="row">
            {{ trans('word_answer/names.label.word_name') }}: {{ $wordAnswer->word->content }}<br>
            {{ trans('word_answer/names.label.word_answer_content') }}: {{ $wordAnswer->content }}<br>
            {{ trans('word_answer/names.label.word_answer_correct') }}: {{ $wordAnswer->correct ? trans('word_answer/names.label.word_answer_correct_true') : trans('word_answer/names.label.word_answer_correct_false') }}<br>
            {{ trans('names.times.create_at_time') }}: {{ $wordAnswer->created_at }}<br>
            {{ Form::open(['route' => ['admin.word_answer.destroy', $wordAnswer->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('word_answer/messages.confirm.message_confirm_delete') . '")']) }}
            <a href="{{ route('admin.word_answer.edit', ['id' => $wordAnswer->id]) }}">
                <button type="button" class="btn btn-warning">
                    <span class="glyphicon glyphicon-pencil"></span> {{ trans('names.button.button_update') }}
                </button>
            </a>
            <a href="{{ route('admin.word_answer.index') }}">
                <button type="button" class="btn btn-primary">
                    <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
                </button>
            </a>
            {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger delete']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
