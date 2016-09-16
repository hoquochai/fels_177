<div class="panel panel-primary" id="user-list">
	<div class="panel-heading">
		<h3>{{ trans('client/name.master.heading_panel_user_list') }}</h3>
	</div>
	<div class="panel-body">
		@if ($users->count() == 0)
			<div class="alert alert-info">
				{{ trans('client/message.master.have_not_users') }}
			</div>
		@endif
		@foreach ($users as $client)
			<div class="row">
				<div class="col-lg-3">
					<img src="{{ asset(config('common.user.path.avatar_url') . $client->avatar) }}" width="40px" height="40">
				</div>
				<div class="col-lg-9">
					{{ $client->name }} <br>
					<div class="btn-group">
						<a href="{{ $relationships->contains($client->id) ? "#" : route('follow.edit', ['id' => $client->id]) }}">
							<button class="btn btn-success btn-xs {{ $relationships->contains($client->id) ? "disabled" : "" }}">
								{{ trans('names.button.button_follow') }}
							</button>
						</a>
						<a href="{{ $relationships->contains($client->id) ? route('unfollow.edit', ['id' => $client->id]) : "#" }}">
							<button class="btn btn-warning btn-xs {{ $relationships->contains($client->id) ? "" : "disabled" }}">
								{{ trans('names.button.button_unfollow') }}
							</button>
						</a>
					</div>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
</div>
