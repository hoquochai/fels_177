<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $config = config('common.category');
        return [
            'name' => 'required|max:' . $config['length']['category_name_length'],
            'introduction' => 'required|max:' . $config['length']['category_introduction_length'],
            'image' => 'file|image|max:' . $config['file']['image_max_size'],
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
            'name.required' => trans('category/validations.admin.name.required'),
            'name.max' => trans('category/validations.admin.name.max'),
            'introduction.required' => trans('category/validations.admin.introduction.required'),
            'introduction.max' => trans('category/validations.admin.introduction.max'),
            'image.file' => trans('category/validations.admin.image.file'),
            'image.image' => trans('category/validations.admin.image.image'),
            'image.max' => trans('category/validations.admin.image.max'),
        ];
    }
}
