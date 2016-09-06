@extends('admin.master')
@section('title')
    {{ trans('user/names.title') }}
@endsection
@section('head')
    {{ trans('user/names.header_panel.user.header_panel_list_users') }}
@endsection
@section('content')
    @include('admin.message')
    @if ($users->count() == 0)
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-warning-sign"></span> {{ trans('user/messages.warning.list_users_not_found') }}</br>
        </div>
    @endif
    <a href="{{ route('user.create') }}">
        <button type="button" class="btn btn-success">
            <span class="glyphicon glyphicon-user"></span> {{ trans('names.button.button_add') }}
        </button>
    </a>
    <table class="table table-hover table-bordered table-responsive dataTable" id="listAllUser">
        <thead>
        <tr>
            <th>{{ trans('user/names.label.user_name') }}</th>
            <th>{{ trans('user/names.label.user_email') }}</th>
            <th>{{ trans('user/names.label.user_avatar') }}</th>
            <th>{{ trans('names.action_table_head') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <img src="{{ asset(config('common.user.path.avatar_url') . $user->avatar) }}" width="60px"
                         height="60px">
                </td>
                <td>
                    <div class="btn-group">
                        {{ Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE', 'onsubmit' => 'return confirmDelete("' . trans('user/messages.confirm.message_confirm_delete') . '")']) }}
                        <a href="{{ route('user.show', ['id' => $user->id]) }}">
                            <button type="button" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-user"></span> {{ trans('names.button.button_detail') }}
                            </button>
                        </a>
                        <a href="{{ route('user.edit', ['id' => $user->id]) }}">
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
    @if ($users->count())
        <div class="row">
            <div class="dataTables_info" id="sample_1_info">
                {{ trans_choice('names.paginations', $users->total(), ['start' => $users->firstItem(), 'finish' => $users->lastItem(), 'numberOfRecords' => $users->total()]) }}
            </div>
            <div class="pagination pagination-lg">
                {{ $users->render() }}
            </div>
        </div>
    @endif
@endsection
