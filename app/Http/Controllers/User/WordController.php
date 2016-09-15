<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\UserWord;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\User\UserController;
use App\Http\Requests;
use Illuminate\Support\Facades\App;

class WordController extends UserController
{
    protected $navName = "word";

    /**
     * WordController constructor.
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
        $messageWord = json_encode([
            'words_not_found' => trans('client/message.word.words_not_found'),
            'not_choose_filter' => trans('client/message.word.not_choose_filter'),
            'print_not_words' => trans('client/message.word.print_not_words'),
            'print_success' => trans('client/message.word.print_success'),
            'print_fail' => trans('client/message.word.print_not_words'),
        ]);
        parent::index();
        $categories = Category::pluck('name', 'id');
        $words = Word::all();
        return view('user.word-list', compact('words', 'categories', 'messageWord'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = parent::index();
        $input = $request->only('category', 'type');
        if (empty($input['category']) && is_null($input['type'])) {
            $data = [
                'success' => false,
            ];
        } else {
            $wordId = UserWord::where('user_id', $user->id)->pluck('word_id');
            $type_filter_learned = config('common.word_filter.word_learned_filter');
            $type_filter_not_learned = config('common.word_filter.word_not_learned_filter');
            $type_filter_all = config('common.word_filter.word_all_filter');
            if (empty($input['category'])) {
                switch ($input['type']) {
                    case $type_filter_learned:
                        $words = Word::whereIn('id', $wordId)->get();
                        break;
                    case $type_filter_not_learned:
                        $words = Word::whereNotIn('id', $wordId)->get();
                        break;
                    case $type_filter_all:
                        $words = Word::all();
                        break;
                }
            } else {
                switch ($request->type) {
                    case $type_filter_learned:
                        $words =  Word::where('category_id', $input['category'])->whereIn('id', $wordId)->get();
                        break;
                    case $type_filter_not_learned:
                        $words =  Word::where('category_id', $input['category'])->whereNotIn('id', $wordId)->get();
                        break;
                    default:
                        $words =  Word::where('category_id', $input['category'])->get();
                        break;
                }
            }

            $data = [
                'success' => true,
                'data' => $words,
            ];
        }

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
