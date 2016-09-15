<?php

namespace App\Http\Controllers\User;

use App\Models\UserWord;
use Illuminate\Http\Request;
use App\Http\Controllers\User\UserController;
use App\Http\Requests;

class ResultController extends UserController
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
        $user = parent::index();
        $userWords = UserWord::with('user', 'word')->where('user_id', $user->id)->get();
        return view('user.result', compact('userWords'));
    }
}
