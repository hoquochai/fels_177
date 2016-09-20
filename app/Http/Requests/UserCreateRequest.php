<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $config = config('common.user');
        return [
            'name' => 'required|max:' . $config['length']['user_name_length'],
            'email' => 'required|email|max:' . $config['length']['user_email_length'] . '|unique:users,email,NULL,NULL,deleted_at,NULL',
            'password' => 'max:' . $config['length']['user_password_length'] . '|required',
            'avatar' => 'file|image|max:' . $config['file']['avatar_max_size'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('user/validations.admin.name.required'),
            'name.max' => trans('user/validations.admin.name.max'),
            'email.required' => trans('user/validations.admin.email.required'),
            'email.email' => trans('user/validations.admin.email.email'),
            'email.unique' => trans('user/validations.admin.email.unique'),
            'password.required' => trans('user/validations.admin.password.required'),
            'password.max' => trans('user/validations.admin.password.max'),
            'avatar.file' => trans('user/validations.admin.avatar.file'),
            'avatar.image' => trans('user/validations.admin.avatar.image'),
            'avatar.max' => trans('user/validations.admin.avatar.max'),
        ];
    }
}
