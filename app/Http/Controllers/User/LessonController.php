<?php

namespace App\Http\Controllers\User;

use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\UserWord;
use App\Models\Word;
use App\Models\WordAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\User\UserController;
use App\Http\Requests;
use DB;
use Exception;

class LessonController extends UserController
{
    protected $navName = "category";

    /**
     * LessonController constructor.
     */
    public function __construct()
    {
        parent::__construct($this->navName);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only('word', 'choice');
        $condition = [
            'word_id' => $input['word'],
            'correct' => config('common.word_answer.correct.result_true'),
        ];
        if ($request->ajax() && !is_null($input['choice'])) {
            $wordTrues = WordAnswer::where($condition)->get();
            if ($wordTrues->count()) {
                $id = auth()->user()->id;
                foreach ($wordTrues as $wordTrue) {
                    if ($wordTrue->id == $input['choice']) {
                        $data = [
                            'user_id' => $id,
                            'word_id' => $input['word'],
                        ];
                    }
                }

                if (isset($data)) {
                    UserWord::firstOrCreate($data);
                }
            }

            $result = [
                'success' => true,
                'dataResult' => $wordTrues,
            ];
        } else {
            $result = [
                'success' => false,
            ];
        }

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        parent::index();
        $messageLesson = json_encode([
            'question_not_answer' => trans('client/message.lesson.question_not_answer'),
            'user_not_answer' => trans('client/message.lesson.user_not_answer'),
            'answer_incorrect' => trans('client/message.lesson.answer_incorrect'),
            'answer_correct' => trans('client/message.lesson.answer_correct'),
            'confirm_view_result' => trans('client/message.lesson.confirm_view_result'),
            'button_view_result' => trans('names.button.button_view_result'),
        ]);
        $word = Word::where('category_id', $id)->whereNotIn('id', function ($query) {
            $query->select('word_id')->from('user_words')->where('user_id', auth()->user()->id);
        })->get();
        if ($word->count() == 0) {
            $message = trans('client/message.lesson.word_not_exists');
            parent::create($id, config('common.activity.activity_learned'));
            return view('user.lesson', compact('word', 'message'));
        }

        $word = $word->random();
        $wordAnswers = WordAnswer::where('word_id', $word->id)->get();
        try {
            DB::beginTransaction();
            $lesson = [
                'category_id' => $id,
                'name' => $word->content,
            ];
            $lessionID = Lesson::create($lesson)->id;
            $lessonWord = [
                'lesson_id' => $lessionID,
                'word_id' => $word->id,
            ];
            LessonWord::create($lessonWord);
            parent::create($id, config('common.activity.activity_learning'));
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = trans('client/message.lesson.create_lesson_fail');
            return view('user.lesson', compact('word', 'message'));
        }

        return view('user.lesson', compact('word', 'wordAnswers', 'id', 'messageLesson'));
    }
}
