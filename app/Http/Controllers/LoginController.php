<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Display login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Handle login system
     *
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()->roles == config('roles.admin')) {
                return redirect()->route('admin.home');
            }

            return redirect()->route('home.index');
        }

        $message = trans('names.login_fail');
        return redirect()->route('getLogin')->with('message', $message);
    }

    /**
     * Handle login system
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
