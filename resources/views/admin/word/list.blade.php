@extends('admin.master')
@section('title')
    {{ trans('word/names.title') }}
@endsection
@section('head')
    {{ trans('word/names.header_panel.header_panel_list_words') }}
@endsection
@section('content')
    @include('admin.message')
    @if ($words->count() == 0)
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-warning-sign"></span> {{ trans('word/messages.warning.list_words_not_found') }}</br>
        </div>
    @endif
    <a href="{{ route('word.create') }}">
        <button type="button" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span> {{ trans('names.button.button_add') }}
        </button>
    </a>
    <table class="table table-hover table-bordered table-responsive dataTable" id="listAllWord">
        <thead>
        <tr>
            <th>{{ trans('word/names.label.category_name') }}</th>
            <th>{{ trans('word/names.label.word_content') }}</th>
            <th>{{ trans('names.action_table_head') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($words as $word)
            <tr>
                <td>{{ $word->category->name }}</td>
                <td>{{ $word->content }}</td>
                <td>
                    <div class="btn-group">
                        {{ Form::open(['route' => ['word.destroy', $word->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('word/messages.confirm.message_confirm_delete') . '")']) }}
                        <a href="{{ route('word.show', ['id' => $word->id]) }}">
                            <button type="button" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-list"></span> {{ trans('names.button.button_detail') }}
                            </button>
                        </a>
                        <a href="{{ route('word.edit', ['id' => $word->id]) }}">
                            <button type="button" class="btn btn-warning btn-xs">
                                <span class="glyphicon glyphicon-pencil"></span> {{ trans('names.button.button_update') }}
                            </button>
                        </a>
                        {{ Form::button('<span class="glyphicon glyphicon-remove"></span> ' . trans('names.button.button_delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete']) }}
                        {{ Form::close() }}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if ($words->count())
        <div class="row">
            <div class="dataTables_info" id="sample_1_info">
                {{ trans_choice('names.paginations', $words->total(), ['start' => $words->firstItem(), 'finish' => $words->lastItem(), 'numberOfRecords' => $words->total()]) }}
            </div>
            <div class="pagination pagination-lg">
                {{ $words->render() }}
            </div>
        </div>
    @endif
@endsection
