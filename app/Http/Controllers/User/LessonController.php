<?php

namespace App\Http\Controllers\User;

use App\Events\Log;
use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\UserWord;
use App\Models\Word;
use App\Models\WordAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Exception;

class LessonController extends Controller
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
        $numberOfQuestion = config('common.result.default_number_record_result');
        $user = auth()->user();
        $messageLesson = json_encode([
            'question_not_answer' => trans('client/lesson/messages.lesson.question_not_answer'),
            'user_not_answer' => trans('client/lesson/messages.lesson.user_not_answer'),
            'answer_incorrect' => trans('client/lesson/messages.lesson.answer_incorrect'),
            'answer_correct' => trans('client/lesson/messages.lesson.answer_correct'),
            'confirm_view_result' => trans('client/lesson/messages.lesson.confirm_view_result'),
            'button_view_result' => trans('names.button.button_view_result'),
        ]);
        $numberOfLesson = Lesson::where('category_id', $id)->count();
        $lessonName = trans('client/lesson/names.lesson.name_lesson', ['lessonNumbers' => $numberOfLesson + 1]);
        $idWordUserLearned = UserWord::where('user_id', $user->id)->pluck('id');
        $words = Word::inRandomOrder()->where('category_id', $id)->whereNotIn('id', $idWordUserLearned)->take($numberOfQuestion)->pluck('content', 'id')->toArray();
        list($idWords, $nameWords) = array_divide($words);
        if (count($idWords) == 0) {
            $message = trans('client/message.lesson.word_not_exists');
            parent::create($id, config('common.activity.activity_learned'));
            return view('user.lesson', compact('words', 'message'));
        }

        $wordAnswers = WordAnswer::whereIn('word_id', $idWords)->get()->toArray();
        try {
            DB::beginTransaction();
            $lesson = [
                'category_id' => $id,
                'name' => $lessonName,
            ];
            $lessionID = Lesson::firstOrCreate($lesson)->id;
            foreach ($idWords as $idWord) {
                $lessonWord = [
                    'lesson_id' => $lessionID,
                    'word_id' => $idWord,
                ];
                LessonWord::firstOrCreate($lessonWord);
            }

            event(new Log($id, config('common.activity.activity_learning')));
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = trans('client/message.lesson.create_lesson_fail');
            return view('user.lesson', compact('words', 'message'));
        }

        $words = json_encode($words);
        $wordAnswers = json_encode($wordAnswers);
        return view('user.lesson', compact('words', 'wordAnswers', 'id', 'messageLesson', 'lessonName', 'numberOfQuestion'));
    }
}
