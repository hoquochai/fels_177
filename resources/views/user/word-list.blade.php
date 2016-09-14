@extends('user.master')
@section('title')
    {{ trans('client/name.word_list.title_word_list_client') }}
@endsection
@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading"><h1>{{ trans('client/name.word_list.heading_panel_word_list') }}</h1></div>
            <div class="panel-body">
                <div class="row">
                    <div class = "col-lg-6">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="messageFilter" value="{{ $messageWord }}">
                        <input type="hidden" name="routeFilter" value="{{ route('word.store') }}">
                        <div class="form-group">
                            {{ Form::label(trans('word/names.label_key.label_key_name_category'), trans('word/names.label.category_name')) }}
                            {{ Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => trans('word/names.placeholder.category_placeholder')]) }}
                        </div>
                    </div>
                    <div class = "col-lg-6">
                        {{ Form::label(trans('client/name.word_list.label_filter_key'), trans('client/name.word_list.label_filter_type')) }}<br>
                        {{ Form::radio('type', config('common.word_filter.word_learned_filter')) }}
                        {{ Form::label(trans('client/name.word_list.label_word_learned_filter_key'), trans('client/name.word_list.label_word_learned_filter')) }}
                        {{ Form::radio('type', config('common.word_filter.word_not_learned_filter')) }}
                        {{ Form::label(trans('client/name.word_list.label_word_not_learned_filter_key'), trans('client/name.word_list.label_word_not_learned_filter')) }}
                        {{ Form::radio('type', config('common.word_filter.word_all_filter')) }}
                        {{ Form::label(trans('client/name.word_list.label_word_all_filter_key'), trans('client/name.word_list.label_word_all_filter')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <button class="btn btn-primary col-lg-5" id="btn-filter">{{ trans('names.button.button_filter') }}</button>
                        <a href="{{ route('export-pdf.index') }}"><button class="btn btn-primary col-lg-5 col-lg-offset-1">{{ trans('names.button.button_pdf') }}</button></a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary" id="all-word-box">
                            <div class="panel-heading">{{ trans('client/name.word_list.heading_panel_word_list_filter') }}</div>
                            <div class="panel-body">
                                @foreach ($words as $word)
                                    <div class="col-lg-6">
                                        {{ $word->content }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-primary" id="filter-result-box">
                            <div class="panel-heading">{{ trans('client/name.word_list.heading_panel_word_filter_result') }}</div>
                            <div class="panel-body">
                                <div class="filter-result">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
