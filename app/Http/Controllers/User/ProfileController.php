<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use File;
use App\Http\Controllers\User\UserController;
use App\Http\Requests;

class ProfileController extends UserController
{
    protected $navName = "profile";

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
        parent::index();
        return view('user.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = parent::index();
        $pathAvatar = config('common.user.path.avatar_url');
        $uploadFail = trans('user/messages.errors.avatar_upload_failed');
        $avatarDefault = config('common.user.path.default_name_avatar');
        if ($request->hasFile('avatar')) {
            $oldAvatar = public_path() . $pathAvatar . $user->avatar;
            if ($user->avatar != $avatarDefault && File::exists($oldAvatar)) {
                try {
                    unlink($oldAvatar);
                } catch (Exception $e) {
                    return redirect()->route('profile.edit', ['id' => $id])->with('message', $uploadFail);
                }
            }

            $avatar = $request->avatar;
            $fileName = uniqid() . '.' . $avatar->getClientOriginalExtension();
            try {
                $avatar->move(public_path() . $pathAvatar, $fileName);
            } catch (Exception $e) {
                return redirect()->route('profile.edit', ['id' => $id])->with('message', $uploadFail);
            }
        } else {
            $fileName = $user->avatar;
        }

        $input = $request->only('name', 'email');
        $input['avatar'] = $fileName;
        $user->update($input);
        $message = trans('user/messages.success.update_user_success');
        return redirect()->route('profile.index')->with('message', $message);
    }
}
