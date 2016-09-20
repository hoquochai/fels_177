<div class="container-fluid">
	<div class="row">
		{{ trans('client/lesson/names.lesson.progress_lesson') }} <span class="badge">{{ $currentQuestion  + 1 }} / {{ $totalQuestion }}</span><br>
	</div>
	<div class="row">
		<div class="row" id="row-question-miss">
			<label>{{ trans('client/lesson/names.lesson.lesson_queue') }} </label>
			<div class="btn-group" id="question-miss"></div>
		</div>
		<hr>
		<div class="container-fluid">
			<h3><b><i>{{ $nameOfWord }}</i></b> <button class="btn btn-default" onclick="speak()">{{ trans('names.button.button_speak') }}</button></h3>
			<hr>
			@foreach ($answers as $answer)
				<div class="form-group">
					<label>
						<input type="radio" name="answer" id="{{ $answer->id }}" value="{{ $answer->id }}"
							   onclick="saveAnswer('{{ $currentQuestion }}', '{{ $wordId }}')">  {{ $answer->content }}
					</label>
				</div>
			@endforeach
			<div class="btn-group">

				{{-- Button previous--}}
				@if ($currentQuestion > 0)
					@if ($currentQuestion - 1 >= 0)
						<button class="btn btn-primary btn-xs btn-previous" onclick="showQuestion({{ $currentQuestion }} - 1)">
							{{ trans('names.button.button_previous') }}
						</button>
					@else
						<button class="btn btn-primary btn-xs btn-previous" onclick="showQuestion({{ $currentQuestion }})">
							{{ trans('names.button.button_previous') }}
						</button>
					@endif
				@endif

				{{-- Button next--}}
				@if ($currentQuestion < $totalQuestion)
					@if ($currentQuestion + 1 < $totalQuestion)
						<button class="btn btn-primary btn-xs btn-next" onclick="showQuestion({{ $currentQuestion }} + 1)">
							{{ trans('names.button.button_next') }}
						</button>
					@else
						<button class="btn btn-primary btn-xs btn-next" onclick="showQuestion({{ $currentQuestion }})">
							{{ trans('names.button.button_next') }}
						</button>
					@endif
				@endif

				{{-- Button submit--}}
				<button class="btn btn-success btn-xs" onclick='submitLesson()'> {{ trans('names.button.button_submit') }}</button>
			</div>
		</div>
	</div>
</div>
