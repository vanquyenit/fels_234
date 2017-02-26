<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|unique:courses,name',
            'category' => 'required',
            'image' => 'required',
            'describe' => 'required|min:30|max:300'
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
            'name.required' => trans('course.courses.error_course_name'),
            'name.unique' => trans('course.courses.exits_course_name'),
            'category.required' => trans('course.courses.error_course_cate'),
            'image.required' => trans('course.courses.error_image'),
            'describe.required' => trans('course.courses.error_course_des'),
            'describe.min' => trans('course.courses.min_course_des'),
            'describe.max' => trans('course.courses.max_course_des'),
        ];
    }
}
