<?php

namespace App\Http\Controllers\User;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Relationship;
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
        $sortStyle = config('common.sort.sort_descending');
        $idFollowings = Relationship::where('follower_id', $user->id)->pluck('following_id');
        $countWordUserLearned = UserWord::where('user_id', $user->id)->count();
        $userFollows = User::whereIn('id', $idFollowings)->paginate(5);
        $activities = Activity::whereIn('user_id', $idFollowings)->orWhere('user_id', $user->id)->orderBy('id', $sortStyle)->get();
        $idUser = [];
        $idCategory = [];
        foreach ($activities as $activity) {
            if ($activity->action_type == config('common.activity.activity_follow') ||
                $activity->action_type == config('common.activity.activity_un_follow')) {
                if (!in_array($activity->user_id, $idUser)) {
                    $idUser = array_prepend($idUser, $activity->user_id);
                }

                if (!in_array($activity->target_id, $idUser)) {
                    $idUser = array_prepend($idUser, $activity->target_id);
                }
            } else {
                if (!in_array($activity->user_id, $idUser)) {
                    $idUser = array_prepend($idUser, $activity->user_id);
                }

                if (!in_array($activity->target_id, $idCategory)) {
                $idCategory = array_prepend($idCategory,$activity->target_id);
                }
            }
        }

        $userActivities = User::whereIn('id', $idUser)->where('roles', config('roles.user'))->get();
        $categories = Category::whereIn('id', $idCategory)->get();
        $avatars = $userActivities->pluck('avatar', 'id');
        $names = $userActivities->pluck('name', 'id');
        $nameCategories=$categories->pluck('name', 'id');
        $imageCategories=$categories->pluck('image', 'id');
        return view('user.home', compact('countWordUserLearned', 'userFollows', 'activities',
            'avatars', 'names', 'nameCategories', 'imageCategories'));
    }
}
