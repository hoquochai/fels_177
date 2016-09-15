<?php

namespace App\Http\Controllers\User;

use App\Models\Activity;
use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct($navName)
    {
        parent::__construct($navName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::where('id', '<>', $user->id)->where('roles', config('roles.user'))->get();
        $relationships = Relationship::where('follower_id', $user->id)->pluck('following_id')->toArray();
        view()->share([
            'users' => $users,
            'user' => $user,
            'relationships' => $relationships,
        ]);

        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $target
     * @param $action
     *
     * @return \Illuminate\Http\Response
     */
    public function create($target, $action)
    {
        $data = [
            'target_id' => $target,
            'action_type' => $action,
            'user_id' => auth()->user()->id,
        ];
        Activity::firstOrCreate($data);
    }
}
