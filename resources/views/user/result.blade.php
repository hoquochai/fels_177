@extends('user.master')
@section('title')
    {{ trans('client/result/names.result.title_result_client') }}
@endsection
@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        @if (isset($message))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif
        @if ($lessons->count())
            {{ Form::hidden('_token', csrf_token()) }}
            {{ Form::hidden('route', route('result.store')) }}
            {{ Form::hidden('routeResult', route('result.index')) }}
            {{ Form::hidden('messageLesson', $messageLesson) }}
            <div class="panel panel-primary" id="result">
                <div class="panel-heading">
                    <h1>{{ trans('client/result/names.result.heading_panel_result') }}</h1>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('client/result/names.table.category_head_name') }}</th>
                            <th>{{ trans('client/result/names.table.lesson_head_name') }}</th>
                            <th>{{ trans('client/result/names.table.start_head_name') }}</th>
                            <th>{{ trans('client/result/names.table.action_head_name') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lessons as $lesson)
                            <tr>
                                <td>{{ $lesson->category->name }}</td>
                                <td>{{ $lesson->name }}</td>
                                <td>{{ $lesson->created_at }}</td>
                                <td>
                                    <button class="btn btn-primary view-lesson" id="{{ $lesson->id }}" onclick="showLesson()">{{ trans('names.button.button_view_lesson') }}</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $lessons->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info">
                {{ trans('client/result/names.result.lesson_not_found') }}
            </div>
        @endif
    </div>
@endsection
