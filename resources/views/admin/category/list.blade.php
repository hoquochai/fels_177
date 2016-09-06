@extends('admin.master')
@section('title')
    {{ trans('category/names.title') }}
@endsection
@section('head')
    {{ trans('category/names.header_panel.header_panel_list_categories') }}
@endsection
@section('content')
    @include('admin.message')
    @if ($categories->count() == 0)
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-warning-sign"></span> {{ trans('category/messages.warning.list_categories_not_found') }}</br>
        </div>
    @endif
    <a href="{{ route('category.create') }}">
        <button type="button" class="btn btn-success">
            <span class="glyphicon glyphicon-plus"></span> {{ trans('names.button.button_add') }}
        </button>
    </a>
    <table class="table table-hover table-bordered table-responsive dataTable" id="listAllCategory">
        <thead>
        <tr>
            <th>{{ trans('category/names.label.category_name') }}</th>
            <th>{{ trans('category/names.label.category_introduction') }}</th>
            <th>{{ trans('category/names.label.category_image') }}</th>
            <th>{{ trans('names.action_table_head') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->introduction }}</td>
                <td>
                    <img src="{{ asset(config('common.category.path.image_url') . $category->image) }}" width="60px"
                         height="60px">
                </td>
                <td>
                    <div class="btn-group">
                        {{ Form::open(['route' => ['category.destroy', $category->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('category/messages.confirm.message_confirm_delete') . '")']) }}
                        <a href="{{ route('category.show', ['id' => $category->id]) }}">
                            <button type="button" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-list-alt"></span> {{ trans('names.button.button_detail') }}
                            </button>
                        </a>
                        <a href="{{ route('category.edit', ['id' => $category->id]) }}">
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
    @if ($categories->count())
        <div class="row">
            <div class="dataTables_info"
                 id="sample_1_info">{{ trans('category/names.pagination.detail_pagination') . ' ' . $categories->total() . ' ' . trans('category/names.pagination.entries_pagination') }}</div>
            <div class="pagination pagination-lg">
                {{ $categories->render() }}
            </div>
        </div>
    @endif
@endsection
