@extends('admin.master')
@section('title')
    {{ trans('word_answer/names.title') }}
@endsection
@section('head')
    {{ trans('word_answer/names.header_panel.header_panel_edit_word_answer') }}
@endsection
@section('content')
    @include('admin.error')
    @if (isset($message))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-warning-sign"></span> {{ $message }}</br>
        </div>
    @endif
    {{ Form::open(['route' => ['admin.word_answer.update', $wordAnswer->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('word_answer/names.label_key.label_key_name_word'), trans('word_answer/names.label.word_name') . trans('names.required')) }}
        {{ Form::select('word_id', $words, $wordAnswer->word->id, ['class' => 'form-control', 'placeholder' => trans('word_answer/names.placeholder.word_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('word_answer/names.label_key.label_key_content'), trans('word_answer/names.label.word_answer_content') . trans('names.required')) }}
        {{ Form::text('content', $wordAnswer->content, ['class' => 'form-control', 'placeholder' => trans('word_answer/names.placeholder.word_answer_content_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('word_answer/names.label_key.label_key_correct'), trans('word_answer/names.label.word_answer_correct') . trans('names.required')) }}
        {{ Form::radio('correct', config('common.word_answer.correct.result_true'), $wordAnswer->correct ? true : "") }} {{ Form::label(trans('word_answer/names.label_key.label_key_correct_true'), trans('word_answer/names.label.word_answer_correct_true')) }}
        {{ Form::radio('correct', config('common.word_answer.correct.result_false'), $wordAnswer->correct ? "" : true) }} {{ Form::label(trans('word_answer/names.label_key.label_key_correct_false'), trans('word_answer/names.label.word_answer_correct_false')) }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_update'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('admin.word_answer.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
    {{ Form::open(['route' => ['admin.word_answer.destroy', $wordAnswer->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('word_answer/messages.confirm.message_confirm_delete') . '")']) }}
    <i>{{ trans('word_answer/names.label.label_delete_word_answer') }}</i>
    {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete']) }}
    {{ Form::close() }}
@endsection
