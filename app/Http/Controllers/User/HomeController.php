<?php

namespace App\Http\Controllers\User;

use App\Models\Activity;
use App\Models\User;
use App\Models\UserWord;
use Illuminate\Http\Request;
use App\Http\Controllers\User\UserController;
use App\Http\Requests;

class HomeController extends UserController
{
    protected $navName = "home";

    /**
     * HomeController constructor.
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
        $user = parent::index();
        $countWordUserLearned = UserWord::where('user_id', $user->id)->count();
        $userFollows = User::whereIn('id', function($query) use($user) {
            $query->select('following_id')->from('relationships')->where('follower_id', $user->id)->where('deleted_at', null)->get();
        })->paginate(5);
        $activities = Activity::whereIn('user_id', function($query) use($user){
            $query->select('following_id')->from('relationships')->where('follower_id', $user->id);
        })->get();

        return view('user.home', compact('countWordUserLearned', 'userFollows', 'activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
