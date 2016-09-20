<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordAnswerRequest extends FormRequest
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
        $config = config('common.word_answer');
        return [
            'word_id' => 'required',
            'content' => 'required|max:' . $config['length']['word_answer_content_length'],
            'correct' => 'required',
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
            'word_id.required' => trans('word_answer/validations.admin.word.required'),
            'content.required' => trans('word_answer/validations.admin.content.required'),
            'content.max' => trans('word_answer/validations.admin.content.max'),
            'correct.required' => trans('word_answer/validations.admin.correct.required'),
        ];
    }
}
