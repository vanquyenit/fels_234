<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'fullname' => 'required|min:6|max:50',
            'username' => 'required|min:5|max:30',
            'email' => 'required|email',
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
            'fullname.required' => trans('language.admin.users.enter_fullname'),
            'fullname.min' => trans('language.admin.users.min_fullname'),
            'fullname.max' => trans('language.admin.users.max_fullname'),
            'username.required' => trans('language.admin.users.enter_username'),
            'username.min' => trans('language.admin.users.min_username'),
            'username.max' => trans('language.admin.users.max_username'),
            'email.required' => trans('language.admin.users.enter_email'),
            'email.email' => trans('language.admin.users.error_email'),
        ];
    }
}
