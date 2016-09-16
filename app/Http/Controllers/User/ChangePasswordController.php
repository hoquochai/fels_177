<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    protected $navName = "profile";

    /**
     * ChangePasswordController constructor.
     */
    public function __construct()
    {
        parent::__construct($this->navName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordRequest $request, $id)
    {
        $user = auth()->user();;
        if (Hash::check($request->password, $user->password)) {
            $user->update(['password' => $request->password_new]);
            return redirect()->route('logout');
        }

        $message = trans('user/messages.errors.password_incorrect');
        return redirect()->route('profile.index')->with('message', $message);
    }
}
