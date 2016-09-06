<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Word;
use App\Http\Requests\WordRequest;
use App\Http\Controllers\Controller;
use DB;
use Exception;

class WordController extends Controller
{
    protected $navName = 'word';

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
        $numberRecord = config('common.word.pagination.default_number_record_word');
        $sortStyle = config('common.sort.sort_descending');
        $words = Word::with('category')->orderBy('id', $sortStyle)->paginate($numberRecord);
        return view('admin.word.list', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.word.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request)
    {
        $input = $request->only('category_id', 'content');
        Word::firstOrCreate($input);
        return redirect()->route('word.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $word = Word::findOrFail($id);
        return view('admin.word.detail', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $word = Word::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.word.edit', compact('word', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\WordRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordRequest $request, $id)
    {
        $word = Word::findOrFail($id);
        $input = $request->only('category_id', 'content');
        $message = trans('word/messages.success.update_word_success');
        $word->update($input);
        return redirect()->route('word.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        try {
            DB::beginTransaction();
            $word->wordAnswers()->delete();
            $word->delete();
            DB::commit();
            $message = trans('word/messages.success.delete_word_success');
        } catch (Exception $ex) {
            DB::rollBack();
            $message = trans('word/messages.errors.delete_word_fail');
        }

        return redirect()->route('word.index')->with('message', $message);
    }
}
