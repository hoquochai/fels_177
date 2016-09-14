<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use File;
use DB;
use Exception;

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
        $numberRecord = config('common.user.pagination.default_number_record');
        $sortStyle = config('common.sort.sort_descending');
        $isUser = config('roles.user');
        $users = User::where('roles', $isUser)->orderBy('id', $sortStyle)->paginate($numberRecord);
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $config = config('common.user.path');
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $fileName = uniqid() . '.' . $avatar->getClientOriginalExtension();
            try {
                $avatar->move(public_path() . $config['avatar_url'], $fileName);
            } catch (Exception $e) {
                $message = trans('user/validations.admin.avatar.move');
                return redirect()->route('admin.user.create')->with('message', $message);
            }
        } else {
            $fileName = $config['default_name_avatar'];
        }

        $input = $request->only('name', 'email', 'password');
        $input['avatar'] = $fileName;
        $input['roles'] = config('roles.user');
        User::firstOrCreate($input);
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserEditRequest $request
     * @param  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $pathAvatar = config('common.user.path.avatar_url');
        $uploadFail = trans('user/messages.errors.avatar_upload_failed');
        $avatarDefault = config('common.user.path.default_name_avatar');
        if ($request->hasFile('avatar')) {
            $oldAvatar = public_path() . $pathAvatar . $user->avatar;
            if ($user->avatar != $avatarDefault && File::exists($oldAvatar)) {
                try {
                    unlink($oldAvatar);
                } catch (Exception $e) {
                    return redirect()->route('admin.user.edit', ['id' => $id])->with('message', $uploadFail);
                }
            }

            $avatar = $request->avatar;
            $fileName = uniqid() . '.' . $avatar->getClientOriginalExtension();
            try {
                $avatar->move(public_path() . $pathAvatar, $fileName);
            } catch (Exception $e) {
                return redirect()->route('admin.user.edit', ['id' => $id])->with('message', $uploadFail);
            }
        } else {
            $fileName = $user->avatar;
        }

        $input = $request->only('name', 'email');
        $input['avatar'] = $fileName;
        $user->update($input);
        $message = trans('user/messages.success.update_user_success');
        return redirect()->route('admin.user.index')->with('message', $message);
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
        try {
            DB::beginTransaction();
            $pathAvatar = config('common.user.path.avatar_url');
            $avatarDefault = config('common.user.path.default_name_avatar');
            $fileName = public_path() . $pathAvatar . $user->avatar;
            if ($user->avatar !=  $avatarDefault && File::exists($fileName)) {
                try {
                    unlink($fileName);
                } catch (Exception $e) {
                    DB::rollBack();
                    $message = trans('user/messages.errors.delete_user_fail');
                    return redirect()->route('admin.user.index')->with('message', $message);
                }
            }

            $user->lessonResults()->delete();
            $user->userWords()->delete();
            $user->delete();
            DB::commit();
            $message = trans('user/messages.success.delete_user_success');
        } catch (Exception $ex) {
            DB::rollBack();
            $message = trans('user/messages.errors.delete_user_fail');
        }

        return redirect()->route('admin.user.index')->with('message', $message);
    }
}
