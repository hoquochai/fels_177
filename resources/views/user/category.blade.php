@extends('user.master')
@section('title')
    {{ trans('client/category/names.category.title_category_client') }}
@endsection
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>{{ trans('client/category/names.category.heading_panel_category') }}</h1>
            {{ Form::open(['route' => 'category.store', 'method' => 'POST', 'class' => 'form-inline']) }}
            <div class="input-group">
                {{ Form::text('search',  (isset($search) ? $search  : null), ['class' => 'form-control', 'placeholder' => trans('client/category/names.category.placeholder_search')]) }}
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="btnSearch">
                        <span class="glyphicon glyphicon-search" id="seach"></span>
                    </button>
                </span>
            </div>
            {{ Form::close() }}
        </div>
        <div class="panel-body">
            @include('admin.message')
            @if ($categories->count() == 0)
                <div class="alert alert-info">
                    {{ trans('client/category/messages.category.have_not_category') }}
                </div>
            @endif

            @foreach($categories as $category)
                @if ($loop->index % 2 == 0)
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>{{ $category->name }}</h2>
                            <p>{{ $category->introduction }}</p>
                            <a href="{{ route('lesson.show', ['id' => $category->id]) }}">
                                <button class="btn btn-primary">{{ trans('names.button.button_start') }}</button>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <img src="{{ asset(config('common.category.path.image_url') . $category->image) }}"
                                 width="200px" height="200px">
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset(config('common.category.path.image_url') . $category->image) }}"
                                 width="200px" height="200px">
                        </div>
                        <div class="col-lg-8">
                            <h2>{{ $category->name }}</h2>
                            <p>{{ $category->introduction }}</p>
                            <a href="{{ route('lesson.show', ['id' => $category->id]) }}">
                                <button class="btn btn-primary">{{ trans('names.button.button_start') }}</button>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
            {{ $categories->links() }}
        </div>
    </div>
@endsection
