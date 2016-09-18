@extends('user.master')
@section('title')
    {{ trans('client/home/names.home.title_home_client') }}
@endsection
@section('content')
    <div class="row" id="home">
        <div class="col-lg-4">
            <img src="{{asset(config('common.user.path.avatar_url') . $user->avatar)}}" id="avatar-user" width="150px" height="150px"><br>
            <label class="infor-user">{{ $user->name }}</label><br>
            <label class="infor-user">
                <i>{{ trans_choice('client/home/names.home.label_count_word_learned', $numberOfWordWordUserLearned, ['numberOfWords' => $numberOfWordWordUserLearned]) }}</i>
            </label>
            <hr>
            <div class="panel panel-primary">
                <div class="panel-heading">{{ trans('client/home/names.home.label_user_follow') }}</div>
                <div class="panel-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @foreach($userFollows as $userFollow)
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{asset(config('common.user.path.avatar_url') . $userFollow->avatar)}}" width="50px" height="50px">
                            </div>
                            <div class="col-lg-8">
                                {{ $userFollow->name }}<br>
                                <a href="{{ route('unfollow.edit', ['id' => $userFollow->id]) }}"><button class="btn btn-warning btn-xs un-follow" id="{{ $userFollow->id }}">Unfollow</button></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    {{ $userFollows->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-8" id="activity">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('word.index') }}"><button class="col-lg-4 col-lg-offset-1 btn btn-primary"><h2>{{ trans('names.button.button_word_list') }}</h2></button></a>
                    <a href="{{ route('category.index') }}"><button class="col-lg-4 col-lg-offset-2 btn btn-primary"><h2>{{ trans('names.button.button_lesson') }}</h2></button></a>
                </div>
                <div class="row">
                    <h2>Activities</h2>
                    <hr>
                    @foreach($activities as $activity)
                        <div class="row">
                            <div class="col-lg-1">
                                <img src="{{asset(config('common.user.path.avatar_url') . $avatars[$activity->user_id])}}" width="20px" height="20px">
                            </div>
                            <div class="col-lg-11">
                                @if ($activity->action_type == config('common.activity.activity_follow') ||
                                    $activity->action_type == config('common.activity.activity_unfollow'))
                                    <p>
                                        {{ trans_choice('client/activity/names.activity', $activity->action_type,
                                        ['user_name' => $names[$activity->user_id], 'target_name' => $names[$activity->target_id]]) }}
                                        <img src="{{asset(config('common.user.path.avatar_url') . $avatars[$activity->target_id])}}" width="20px" height="20px">
                                    </p>
                                @else
                                    <p>
                                        {{ trans_choice('client/activity/names.activity', $activity->action_type,
                                        ['user_name' => $names[$activity->user_id], 'target_name' => $nameCategories[$activity->target_id]]) }}
                                        <img src="{{asset(config('common.category.path.image_url') . $imageCategories[$activity->target_id])}}" width="20px" height="20px">
                                    </p>

                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
