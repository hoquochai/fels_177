@extends('user.master')
@section('title')
    {{ trans('client/result/names.result.title_result_client') }}
@endsection
@section('content')
    @if (isset($message))
        <div class="alert alert-info">
            {{ $message }}
        </div>
    @endif
    @if ($lessonResults->count())
        <div class="hide-result" data-route-result ="{{ route('result.index') }}"
             data-token = "{{ csrf_token() }}"
             data-route = "{{ route('result.store') }}"
             data-message = "{{ $messageLesson }}">
        </div>
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
                        <th>{{ trans('client/result/names.table.score_head_name') }}</th>
                        <th>{{ trans('client/result/names.table.start_head_name') }}</th>
                        <th>{{ trans('client/result/names.table.action_head_name') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($lessonResults as $lessonResult)
                        <tr>
                            <td>{{ $lessonResult->lesson->category->name }}</td>
                            <td>{{ $lessonResult->lesson->name }}</td>
                            <td>{{ $lessonResult->result}}</td>
                            <td>{{ $lessonResult->lesson->created_at }}</td>
                            <td>
                                <button class="btn btn-primary view-lesson" id="{{ $lessonResult->lesson_id }}"
                                        onclick="showLesson()">{{ trans('names.button.button_view_lesson') }}</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $lessonResults->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-info">
            {{ trans('client/result/names.result.lesson_not_found') }}
        </div>
    @endif
@endsection
