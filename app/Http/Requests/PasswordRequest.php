<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required|max:'. $config['length']['user_password_length'],
            'password_new' => 'required|confirmed|max:'. $config['length']['user_password_length'],
            'password_new_confirmation' => 'required|max:'. $config['length']['user_password_length'],
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
            'password.required' => trans('user/validations.admin.password.required'),
            'password.max' => trans('user/validations.admin.password.max'),
            'password_new.required' => trans('admin_infor/validations.password_new.required'),
            'password_new.confirmed' => trans('admin_infor/validations.password_new.confirmed'),
            'password_new.max' => trans('user/validations.admin.password.max'),
            'password_new_confirmation.required' => trans('admin_infor/validations.password_confirmation.required'),
            'password_new_confirmation.max' => trans('user/validations.admin.password.max'),
        ];
    }
}
