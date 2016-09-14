<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;

use App\Http\Requests;

class FollowController extends UserController
{
    protected $navName = "home";

    /**
     * FollowController constructor.
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
        //
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
        $user = parent::index();
        if ($id != $user->id) {
            $numberOfUser = User::where('id', $id)->get()->count();
            if ($numberOfUser) {
                $data = [
                    'following_id' => $id,
                    'follower_id' => $user->id,
                ];
                try {
                    Relationship::firstOrCreate($data);
                    $this->activity(config('common.action.action_follow', $id));
                    $message = "Follow success";
                } catch (Exception $ex) {
                    $message = "Follow fail";
                }
            } else {
                $message = "User not found";
            }
        } else {
            $message = "Can't follow yourself";
        }
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
