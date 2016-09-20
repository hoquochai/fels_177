<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|max:' . $config['length']['user_email_length'],
            'password' => 'max:' . $config['length']['user_password_length'] . '|required',
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
            'email.required' => trans('user/validations.admin.email.required'),
            'email.max' => trans('user/validations.admin.email.max'),
            'password.required' => trans('user/validations.admin.password.required'),
            'password.max' => trans('user/validations.admin.password.max'),
        ];
    }
}
