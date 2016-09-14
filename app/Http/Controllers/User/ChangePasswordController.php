<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends UserController
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
        $user = parent::index();
        if (Hash::check($request->password, $user->password)) {
            $user->update(['password' => $request->password_new]);
            return redirect()->route('logout');
        }

        $message = trans('user/messages.errors.password_incorrect');
        return redirect()->route('profile.index')->with('message', $message);
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
