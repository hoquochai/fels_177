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
    @if (count($data))
        <div class="panel panel-primary">
            <div class="hide" data-route-result ="{{ route('result.index') }}"
                                data-questions = "{{ $data }}"
                                data-token = "{{ csrf_token() }}"
                                data-route = "{{ route('lesson.store') }}"
                                data-lesson-id = "{{ $lessonId }}">
            </div>
            <div class="panel-heading"><h1>{{ $lessonName }}</h1></div>
            <div class="panel-body" id="question">
            </div>
        </div>
    @endif
@endsection
