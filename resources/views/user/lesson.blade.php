@extends('user.master')
@section('title')
    {{ trans('client/name.lesson.title_lesson_client') }}
@endsection
@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        @if (isset($message))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif
        @if ($word->count())
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1>{{ $word->content }}</h1>
                </div>
                <div class="panel-body">
                    <h3><b><i>{{ $word->content }}</i></b></h3>
                    <div class="form-group">
                        {{ Form::hidden('word', $word->id) }}
                        {{ Form::hidden('_token', csrf_token()) }}
                        {{ Form::hidden('route', route('lesson.store')) }}
                        {{ Form::hidden('message', $messageLesson) }}
                    </div>
                    @foreach($wordAnswers as $wordAnswer)
                        <div class="form-group">
                            <label class="answer"
                                   id="{{ $wordAnswer->id }}">{{ Form::radio('answer', $wordAnswer->id) }} {{ $wordAnswer->content }}
                            </label>
                        </div>
                    @endforeach
                    <hr>
                    <button class="btn btn-success submit">{{ trans('names.button.button_submit') }}</button>
                    <a href="{{ route('lesson.show', ['id' => $id]) }}">
                        <button class="btn btn-primary">{{ trans('names.button.button_next') }}</button>
                    </a>
                    <hr>
                    <div class="result"></div>
                </div>
            </div>
        @endif
    </div>
@endsection
