@extends('user.master')
@section('title')
    {{ trans('client/lesson/names.lesson.title_lesson_client') }}
@endsection
@section('content')
    @if (isset($message))
        <div class="alert alert-info">
            {{ $message }}
        </div>
    @endif
    @if (count($words))
        <div class="panel panel-primary">
            {{ Form::hidden('words', $words) }}
            {{ Form::hidden('wordAnswers', $wordAnswers) }}
            {{ Form::hidden('_token', csrf_token()) }}
            {{ Form::hidden('route', route('lesson.store')) }}
            {{ Form::hidden('message', $messageLesson) }}
            {{ Form::hidden('numberOfQuestion', $numberOfQuestion) }}
            {{ Form::hidden('routeSaveResult', route('result.update', ['id' => $lessonId])) }}
            {{ Form::hidden('routeResult', route('result.index')) }}
            {{ Form::hidden('lessonId', $lessonId) }}
            <div class="panel-heading"><h1>{{ $lessonName }}</h1></div>
            <div class="panel-body">
                <div id="progeessdetail"></div>
                <hr>
                <div class="row">
                    <label>Queue: </label>
                    <div class="btn-group" id="question-miss">

                    </div>
                </div>
                <div id="question"></div>
                <hr>
                <button class="btn btn-success" onclick="submitLesson()">{{ trans('names.button.button_submit') }}</button>
                <div class="result"></div>
            </div>
        </div>
    @endif
@endsection
