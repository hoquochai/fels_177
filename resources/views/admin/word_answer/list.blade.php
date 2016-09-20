@extends('admin.master')
@section('title')
    {{ trans('word_answer/names.title') }}
@endsection
@section('head')
    {{ trans('word_answer/names.header_panel.header_panel_list_word_answers') }}
@endsection
@section('content')
    @include('admin.message')
    @if ($wordAnswers->count() == 0)
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-warning-sign"></span> {{ trans('word_answer/messages.warning.list_word_answers_not_found') }}</br>
        </div>
    @endif
    <a href="{{ route('admin.word_answer.create') }}">
        <button type="button" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span> {{ trans('names.button.button_add') }}
        </button>
    </a>
    <table class="table table-hover table-bordered table-responsive dataTable" id="listAllWordAnswer">
        <thead>
        <tr>
            <th>{{ $messageTrans['label']['word_name'] }}</th>
            <th>{{ $messageTrans['label']['word_answer_content'] }}</th>
            <th>{{ $messageTrans['label']['word_answer_correct'] }}</th>
            <th>{{ trans('names.action_table_head') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($wordAnswers as $wordAnswer)
            <tr class="{{ $wordAnswer->correct ? $messageTrans['class']['word_answer_true_class'] : "" }}">
                <td>{{ $wordAnswer->word->content }}</td>
                <td>{{ $wordAnswer->content }}</td>
                <td>
                    {{ $wordAnswer->correct ? $messageTrans['label']['word_answer_correct_true'] : $messageTrans['label']['word_answer_correct_false'] }}
                </td>
                <td>
                    <div class="btn-group">
                        {{ Form::open(['route' => ['admin.word_answer.destroy', $wordAnswer->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('word_answer/messages.confirm.message_confirm_delete') . '")']) }}
                        <a href="{{ route('admin.word_answer.show', ['id' => $wordAnswer->id]) }}">
                            <button type="button" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-list"></span> {{ trans('names.button.button_detail') }}
                            </button>
                        </a>
                        <a href="{{ route('admin.word_answer.edit', ['id' => $wordAnswer->id]) }}">
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
    @if ($wordAnswers->count())
        <div class="row">
            <div class="dataTables_info" id="sample_1_info">
                {{ trans_choice('names.paginations', $wordAnswers->total(), ['start' => $wordAnswers->firstItem(), 'finish' => $wordAnswers->lastItem(), 'numberOfRecords' => $wordAnswers->total()]) }}
            </div>
            <div class="pagination pagination-lg">
                {{ $wordAnswers->links() }}
            </div>
        </div>
    @endif
@endsection
