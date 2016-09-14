<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserController;
use App\Models\Relationship;
use App\Models\User;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = parent::index();
        if ($id != $user->id) {
            $numberOfUser = User::where('id', $id)->get()->count();
            if ($numberOfUser) {
                $data = [
                    'following_id' => $id,
                    'follower_id' => $user->id,
                ];
                Relationship::firstOrCreate($data);
                parent::create($id, config('common.activity.activity_follow'));
            }
        }
        return redirect()->route('home.index');
    }
}
