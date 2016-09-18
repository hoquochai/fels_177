<?php

namespace App\Http\Controllers\User;

use App\Events\Log;
use App\Models\Lesson;
use App\Models\LessonResult;
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
        $score = config('common.result.default_score');
        $input = $request->only('questions', 'answers', 'lessonId');
        $userId = auth()->user()->id;
        $userWordDatas = [];
        if ($request->ajax()) {
            if (count($input['questions'])) {
                $wordTrues = WordAnswer::whereIn('word_id', $input['questions'])
                    ->where('correct', config('common.word_answer.correct.result_true'))->pluck('id', 'word_id');;
                for ($i = 0; $i < count($input['questions']); $i++) {
                    if ($input['answers'][$i] == $wordTrues[$input['questions'][$i]]) {
                        $userWordDatas = array_prepend($userWordDatas, [
                            'user_id' => $userId,
                            'word_id' => $input['questions'][$i],
                        ]);
                        $score ++;
                    }
                }
            }

            try {
                DB::beginTransaction();
                LessonResult::firstOrCreate([
                    'user_id' => auth()->user()->id,
                    'lesson_id' => $input['lessonId'],
                    'result' => $score,
                ]);

                if (count($input['questions'])) {
                    $query = 'insert into user_words (user_id, word_id) values ';
                    foreach ($userWordDatas as $userWordData) {
                        $query .= "('" . $userWordData['user_id'] . "','" . $userWordData['word_id'] . "'),";
                    }

                    $query = substr($query, 0, strlen($query) - 1);
                    DB::insert($query);
                }

                DB::commit();
                $data = ['success' => 'true'];
            } catch (Exception $ex) {
                DB::rollBack();
                $data = ['success' => 'false'];
            }

        }


        return response()->json($data);
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
            'progress_lesson' => trans('client/lesson/names.lesson.progress _lesson'),
            'btn_submit' => trans('names.button.button_submit'),
            'btn_next' => trans('names.button.button_next'),
            'btn_finish' => trans('names.button.button_finish'),
            'score_fail' => trans('client/lesson/messages.lesson.score_fail'),
            'button_previous' => trans('names.button.button_previous'),
        ]);
        $idWordUserLearned = UserWord::where('user_id', $user->id)->pluck('word_id');
        $numberOfWord = Word::where('category_id', $id)->whereNotIn('id', $idWordUserLearned)->count();
        if ($numberOfWord < $numberOfQuestion) {
            $message = trans('client/lesson/messages.lesson.missing_words');
            return redirect()->route('category.index')->with('message', $message);
        }

        $numberOfLesson = Lesson::where('category_id', $id)->count();
        $lessonName = trans('client/lesson/names.lesson.name_lesson', ['lessonNumbers' => $numberOfLesson + 1]);
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
            $lessonId = Lesson::firstOrCreate($lesson)->id;
            $lessonWords = [];
            foreach ($idWords as $idWord) {
                $lessonWords = array_prepend($lessonWords,[
                    'lesson_id' => $lessonId,
                    'word_id' => $idWord,
                ]);
            }

            $query = 'insert into lesson_words (lesson_id, word_id) values ';
            foreach ($lessonWords as $lessonWord) {
                $query .= "('" . $lessonWord['lesson_id'] . "','" . $lessonWord['word_id'] . "'),";
            }

            $query = substr($query, 0, strlen($query) - 1);
            DB::insert($query);
            event(new Log($id, config('common.activity.activity_learning')));
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            $message = trans('client/message.lesson.create_lesson_fail');
            return view('user.lesson', compact('words', 'message'));
        }

        $words = json_encode($words);
        $wordAnswers = json_encode($wordAnswers);
        return view('user.lesson', compact('words', 'wordAnswers', 'id', 'messageLesson', 'lessonName', 'numberOfQuestion', 'lessonId'));
    }
}
