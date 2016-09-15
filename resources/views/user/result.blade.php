@extends('user.master')
@section('title')
    {{ trans('client/name.result.title_result_client') }}
@endsection
@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        @if (isset($message))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif
        @if ($userWords->count())
            <div class="panel panel-primary" id="result">
                <div class="panel-heading">
                    <h1>{{ trans('client/name.result.heading_panel_result') }}</h1>
                </div>
                <div class="panel-body">
                    <h3 id="title-body-result">{{ trans('client/name.result.body_panel_result') }}</h3>
                    @foreach ($userWords as $userWord)
                        <p><span class="label label-success">{{ $userWord->word->content }}</span> {{ $userWord->created_at }}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
