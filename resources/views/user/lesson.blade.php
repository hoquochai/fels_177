@extends('user.master')
@section('title')
    {{ trans('client/lesson/names.lesson.title_lesson_client') }}
@endsection
@section('content')
    <div class="col-lg-8 col-lg-offset-2">
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
                <div class="panel-heading"><h1>{{ $lessonName }}</h1></div>
                <div class="panel-body">
                    <div id="question"></div>
                    <hr>
                    <div class="result"></div>
                </div>
            </div>
        @endif
    </div>
@endsection
