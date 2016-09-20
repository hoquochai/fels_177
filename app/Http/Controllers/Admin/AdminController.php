<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Word;
use App\Models\WordAnswer;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    /**
     * Display admin home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $navName = 'home';
        $numberOfUsers = User::where('roles', config('roles.user'))->count();
        $numberOfCategories = Category::count();
        $numberOfWords = Word::count();
        $numberOfWordAnswers = WordAnswer::count();
        return view('admin.index', compact('navName', 'numberOfUsers',
            'numberOfCategories', 'numberOfWords', 'numberOfWordAnswers'));
    }

    /**
     * Display admin profile page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $navName = 'home';
        $admin = auth()->user();
        return view('admin.profile', compact('navName', 'admin'));
    }

    /**
     * Update profile of admin
     *
     * @param UserEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request)
    {
        $admin = auth()->user();
        $pathAvatar = config('common.user.path.avatar_url');
        $uploadFail = trans('user/messages.errors.avatar_upload_failed');
        $avatarDefault = config('common.user.path.default_name_avatar');
        $input = $request->only('name', 'email');
        if ($request->hasFile('avatar')) {
            $oldAvatar = public_path() . $pathAvatar . $admin->avatar;
            if ($admin->avatar != $avatarDefault && File::exists($oldAvatar)) {
                try {
                    unlink($oldAvatar);
                } catch (Exception $e) {
                    return redirect()->route('admin.profile')->with('message', $uploadFail);
                }
            }

            $avatar = $request->avatar;
            $fileName = uniqid() . '.' . $avatar->getClientOriginalExtension();
            try {
                $avatar->move(public_path() . $pathAvatar, $fileName);
            } catch (Exception $e) {
                return redirect()->route('admin.profile')->with('message', $uploadFail);
            }

            $input['avatar'] = $fileName;
        }

        $admin->update($input);
        $message = trans('admin_infor/message.success.update_admin_success');
        return redirect()->route('admin.profile')->with('message', $message);
    }

    /**
     * Change password of admin
     *
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(PasswordRequest $request)
    {
        $admin = auth()->user();
        if (Hash::check($request->password, $admin->password)) {
            $admin->update(['password' => $request->password_new]);
            return redirect()->route('logout');
        }

        $message = trans('admin_infor/message.errors.update_admin_fail');
        return redirect()->route('admin.profile')->with('message', $message);
    }
}
