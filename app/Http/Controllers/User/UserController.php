<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class UserController extends Controller
{

    protected $navName;

    /**
     * UserController constructor.
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
        $users = User::where('id', '<>', $user->id)->where('roles', config('roles.user'))->get();
        view()->share([
            'users' => $users,
            'user' => $user,
        ]);
    }
}
