<?php

namespace App\Http\Controllers\User;

use App\Events\Log;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FollowController extends Controller
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
        $user = auth()->user();;
        $numberOfUser = User::where('id', $id)->where('id', '<>', $user->id)->get()->count();
        if ($numberOfUser) {
            $data = [
                'following_id' => $id,
                'follower_id' => $user->id,
            ];
            Relationship::firstOrCreate($data);
            event(new Log($id, config('common.activity.activity_follow')));
        }

        return redirect()->route('home.index');
    }
}
