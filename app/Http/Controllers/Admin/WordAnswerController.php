<?php

namespace App\Http\Controllers\Admin;

use App\Models\WordAnswer;
use App\Http\Controllers\Controller;
use App\Http\Requests\WordAnswerRequest;
use App\Models\Word;

class WordAnswerController extends Controller
{
    protected $navName = 'word_answer';

    /**
     * WordAnswerController constructor.
     */
    public function __construct()
    {
        parent::__construct($this->navName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberRecord = config('common.word_answer.pagination.default_number_record_word_answer');
        $sortStyle = config('common.sort.sort_descending');
        $wordAnswers = WordAnswer::with('word')->orderBy('id', $sortStyle)->paginate($numberRecord);
        $messageTrans = trans('word_answer/names');
        return view('admin.word_answer.list', compact('wordAnswers', 'messageTrans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $words = Word::pluck('content', 'id');
        return view('admin.word_answer.add', compact('words'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  WordAnswerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordAnswerRequest $request)
    {
        $config = config('common.word_answer.correct');
        $checkIsCorrect = [
            'word_id' => $request->word_id,
            'correct' => $config['result_true'],
            'correct' => $request->correct,
        ];
        WordAnswer::where($checkIsCorrect)->update(['correct' => $config['result_false']]);
        $input = $request->only('word_id', 'content', 'correct');
        WordAnswer::firstOrCreate($input);
        return redirect()->route('word_answer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wordAnswer = WordAnswer::findOrFail($id);
        return view('admin.word_answer.detail', compact('wordAnswer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wordAnswer = WordAnswer::findOrFail($id);
        $words = Word::pluck('content', 'id');
        return view('admin.word_answer.edit', compact('wordAnswer', 'words'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  WordAnswerRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordAnswerRequest $request, $id)
    {
        $wordAnswer = WordAnswer::findOrFail($id);
        $config = config('common.word_answer.correct');
        $checkIsCorrect = [
            'word_id' => $request->word_id,
            'correct' => $config['result_true'],
            'correct' => $request->correct,
        ];
        WordAnswer::where($checkIsCorrect)->update(['correct' => $config['result_false']]);
        $input = $request->only('word_id', 'content', 'correct');
        $wordAnswer->update($input);
        $message = trans('word_answer/messages.success.update_word_answer_success');
        return redirect()->route('word_answer.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wordAnswer = WordAnswer::findOrFail($id);
        $wordAnswer->delete();
        $message = trans('word_answer/messages.success.delete_word_answer_success');
        return redirect()->route('word_answer.index')->with('message', $message);
    }
}
