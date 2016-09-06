@extends('admin.master')
@section('title')
    {{ trans('word_answer/names.title') }}
@endsection
@section('head')
    {{ trans('word_answer/names.header_panel.header_panel_add_word_answer') }}
@endsection
@section('content')
    @include('admin.error')
    @if ($message)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-warning-sign"></span> {{ $message }}</br>
        </div>
    @endif
    {{ Form::open(['route' => 'word_answer.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group">
        {{ Form::label(trans('word_answer/names.label_key.label_key_name_word'), trans('word_answer/names.label.word_name') . trans('names.required')) }}
        {{ Form::select('word_id', $words, null, ['class' => 'form-control', 'placeholder' => trans('word_answer/names.placeholder.word_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('word_answer/names.label_key.label_key_content'), trans('word_answer/names.label.word_answer_content') . trans('names.required')) }}
        {{ Form::text('content', null, ['class' => 'form-control', 'placeholder' => trans('word_answer/names.placeholder.word_answer_content_placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label(trans('word_answer/names.label_key.label_key_correct'), trans('word_answer/names.label.word_answer_correct') . trans('names.required')) }}
        {{ Form::radio('correct', config('common.word_answer.correct.result_true')) }} {{ Form::label(trans('word_answer/names.label_key.label_key_correct_true'), trans('word_answer/names.label.word_answer_correct_true')) }}
        {{ Form::radio('correct', config('common.word_answer.correct.result_false')) }} {{ Form::label(trans('word_answer/names.label_key.label_key_correct_false'), trans('word_answer/names.label.word_answer_correct_false')) }}
    </div>
    {{ Form::button('<span class="glyphicon glyphicon-ok"></span> ' . trans('names.button.button_add'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
    <a href="{{ route('word_answer.index') }}">
        <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('names.button.button_back') }}
        </button>
    </a>
    {{ Form::close() }}
@endsection
