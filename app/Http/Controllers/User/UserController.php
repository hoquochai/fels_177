<?php

namespace App\Http\Controllers\User;

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
        view()->share([
            'users' => $users,
            'user' => $user,
        ]);

        return $user;
    }
}
