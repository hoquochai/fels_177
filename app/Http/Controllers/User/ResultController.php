<?php

namespace App\Http\Controllers\User;

use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\UserWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class ResultController extends Controller
{
    protected $navName = "result";

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
        $messageLesson = json_encode([
            'word_result' => trans('client/result/names.result.word_result'),
            'error_display_word' => trans('client/result/message.result.error_display_word'),
            'result_head_name' => trans('client/result/names.table.result_head_name'),
            'word_head_name' => trans('client/result/names.table.word_head_name'),
            'word_answer_head_name' => trans('client/result/names.table.word_answer_head_name'),
            'question_no_answer' => trans('client/result/names.result.question_no_answer'),
            'btn_back' => trans('names.button.button_back'),
            'is_correct' => config('common.word_answer.correct.result_true'),
            'sign_correct' => trans('client/result/names.result.sign_correct'),
            'sign_incorrect' => trans('client/result/names.result.sign_incorrect'),
        ]);
        $sortStyle = config('common.sort.sort_descending');
        $lessons = Lesson::with('category')->orderBy('id', $sortStyle)->paginate(10);
        return view('user.result', compact('lessons', 'messageLesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $user = auth()->user();
        $lessonWords = LessonWord::with('word.wordAnswers')->where('lesson_id', $id)->get()->toJson();
        $userWords = UserWord::with('word')->where('user_id', $user->id)->get()->toJson();
        if (count($lessonWords) == 0) {
            $data = [
                'result' => false,
            ];
        } else {
            $data = [
                'result' => true,
                'lessonWords' => $lessonWords,
                'userWords' => $userWords,
            ];
        }

        return response()->json($data);
    }
}
