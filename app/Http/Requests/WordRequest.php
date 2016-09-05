<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
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
        $config = config('common.word');
        return [
            'category_id' => 'required',
            'content' => 'required|max:' . $config['length']['word_content_length'],
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
            'category_id.required' => trans('word/validations.admin.category.required'),
            'content.required' => trans('word/validations.admin.content.required'),
            'content.max' => trans('word/validations.admin.content.max'),
        ];
    }
}
