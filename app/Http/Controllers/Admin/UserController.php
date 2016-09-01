<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use File;

class UserController extends Controller
{
    protected $navName = 'user';

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
        $users = User::orderBy('id', 'desc')->paginate(config('common.pagination.default_number_record'));
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $fileName = uniqid() . $avatar->getClientOriginalName();
            try {
                $avatar->move(public_path() . config('common.user.path.avatar_url'), $fileName);
            } catch (Exception $e) {
                $message = trans('user/validations.admin.avatar.move');
                return redirect()->route('user.create')->with('message', $message);
            }
        } else {
            $fileName = config('common.user.path.default_name_avatar');
        }

        $input = $request->only('name', 'email', 'password');
        $input['avatar'] = $fileName;
        $input['roles'] = config('roles.user');
        User::firstOrCreate($input);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(User $user)
    {
        return view('admin.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserEditRequest $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            if ($request->hasFile('avatar')) {
                $oldAvatar = public_path() . config('common.user.path.avatar_url') . $user->avatar;
                if (File::exists($oldAvatar)) {
                    try {
                        unlink($oldAvatar);
                    } catch (Exception $e) {
                        $message = trans('user/validations.admin.avatar.delete');
                        return redirect()->route('user.edit', ['id' => $id])->with('message', $message);
                    }
                }

                $avatar = $request->avatar;
                $fileName = uniqid() . $avatar->getClientOriginalName();
                try {
                    $avatar->move(public_path() . config('common.user.path.avatar_url'), $fileName);
                } catch (Exception $e) {
                    $message = trans('user/validations.admin.avatar.move');
                    return redirect()->route('user.edit', ['id' => $id])->with('message', $message);
                }
            } else {
                $fileName = $user->avatar;
            }

            $input = $request->only('name', 'email');
            $input['avatar'] = $fileName;
            $user->update($input);
            $message = trans('user/messages.success.update_user_success');
        } else {
            $message = trans('user/messages.errors.update_user_success');
        }

        return redirect()->route('user.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            $message = trans('user/messages.success.delete_user_success');
        } else {
            $message = trans('user/messages.errors.delete_user_fail');
        }

        return redirect()->route('user.index')->with('message', $message);
    }
}
