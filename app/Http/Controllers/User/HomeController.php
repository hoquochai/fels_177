<?php

namespace App\Http\Controllers\User;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Relationship;
use App\Models\User;
use App\Models\UserWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class HomeController extends Controller
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
        $user = auth()->user();
        $sortStyle = config('common.sort.sort_descending');
        $numberRecord = config('common.home.default_number_record_follow');
        $idFollowings = Relationship::where('follower_id', $user->id)->pluck('following_id');
        $numberOfWordWordUserLearned = UserWord::where('user_id', $user->id)->count();
        $userFollows = User::whereIn('id', $idFollowings)->paginate($numberRecord);
        $activities = Activity::whereIn('user_id', $idFollowings)->orWhere('user_id', $user->id)->orderBy('id', $sortStyle)->get();
        $userIds = [];
        $categoryIds = [];
        foreach ($activities as $activity) {
            if ($activity->action_type == config('common.activity.activity_follow') ||
                $activity->action_type == config('common.activity.activity_unfollow')) {
                if (!in_array($activity->user_id, $userIds)) {
                    $userIds = array_prepend($userIds, $activity->user_id);
                }

                if (!in_array($activity->target_id, $userIds)) {
                    $userIds = array_prepend($userIds, $activity->target_id);
                }
            } else {
                if (!in_array($activity->user_id, $userIds)) {
                    $userIds = array_prepend($userIds, $activity->user_id);
                }

                if (!in_array($activity->target_id, $categoryIds)) {
                    $categoryIds = array_prepend($categoryIds, $activity->target_id);
                }
            }
        }

        $userActivities = User::whereIn('id', $userIds)->where('roles', config('roles.user'))->get();
        $categories = Category::whereIn('id', $categoryIds)->get();
        $avatars = $userActivities->pluck('avatar', 'id');
        $names = $userActivities->pluck('name', 'id');
        $nameCategories=$categories->pluck('name', 'id');
        $imageCategories=$categories->pluck('image', 'id');
        return view('user.home', compact('user', 'numberOfWordWordUserLearned', 'userFollows', 'activities',
            'avatars', 'names', 'nameCategories', 'imageCategories'));
    }
}
