<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        return [
            'name' => 'required|unique:lessons,name',
            'course' => 'required',
            'level' => 'required',
            'number_word' => 'required',
            'image' => 'required',
        ];
    }

    /**
     * Check error request messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('lesson.lessons.error_name'),
            'name.unique' => trans('lesson.lessons.exits_name'),
            'course.required' => trans('lesson.lessons.error_course'),
            'level.required' => trans('lesson.lessons.error_level'),
            'number_word.required' => trans('lesson.lessons.error_nember'),
            'image.required' => trans('lesson.lessons.error_images'),
        ];
    }
}
