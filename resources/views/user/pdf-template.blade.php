<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
	<style>
		* {
			font-family : firefly, DejaVu Sans, sans-serif;
		}

		#head-pdf {
			text-align: center;
		}
	</style>
</head>
<body>
	<h1 id="head-pdf">{{ trans('client/word_list/names.word_list.header_pdf_file') }}</h1>
	<div id="content-wrap">
		<ul>
			@foreach($wordAnswers as $wordAnswer)
				<li>{{ trans('client/word_list/names.word_list.content_pdf_file',
				['words' => $wordAnswer->word->content, 'wordAnswers' => $wordAnswer->content]) }}</li>
			@endforeach
		</ul>
	</div>

</body>
</html>