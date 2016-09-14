@extends('user.master')
@section('title')
    {{ trans('client/name.home.title_home_client') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4" id="user">
            <img src="{{asset(config('common.user.path.avatar_url') . $user->avatar)}}" id="avatar-user" width="150px" height="150px"><br>
            <label class="infor-user">{{ $user->name }}</label><br>
            <label class="infor-user"><i>{{ trans_choice('client/name.home.label_count_word_learned', $countWordUserLearned, ['numberOfWords' => $countWordUserLearned]) }}</i></label>
            <hr>
            <div class="panel panel-primary">
                <div class="panel-heading">{{ trans('client/name.home.label_user_follow') }}</div>
                <div class="panel-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @foreach($userFollows as $userFollow)
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{asset(config('common.user.path.avatar_url') . $userFollow->avatar)}}" width="50px" height="50px">
                            </div>
                            <div class="col-lg-8">
                                {{ $userFollow->name }}<br>
                                <button class="btn btn-warning btn-xs un-follow" id="{{ $userFollow->id }}">Unfollow</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    {{ $userFollows->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="container-fluid">
                <div class="row">
                    <button class="col-lg-4 col-lg-offset-1 btn btn-primary"><h2>{{ trans('names.button.button_word_list') }}</h2></button>
                    <button class="col-lg-4 col-lg-offset-2 btn btn-primary"><h2>{{ trans('names.button.button_lesson') }}</h2></button>
                </div>
                <div class="row">
                    <h2>Activities</h2>
                    <hr>
                    @foreach($activities as $activity)
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{asset(config('common.user.path.avatar_url') . config('common.user.path.default_name_avatar'))}}" width="100px" height="100px">
                            </div>
                            <div class="col-lg-8">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection