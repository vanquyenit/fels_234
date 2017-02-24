<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|min:5|max:30|unique:users,username',
            'password' => 'required|min:6|max:50',
            'passwordConfirm' => 'required|same:password',
            'email' => 'required|unique:users,email|email',
            'images' => 'required',
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
            'username.unique' => trans('language.admin.users.exits_username'),
            'password.required' => trans('language.admin.users.enter_password'),
            'password.min' => trans('language.admin.users.enter_password_min'),
            'password.max' => trans('language.admin.users.enter_password_max'),
            'password1.required' => trans('language.admin.users.enter_res_pasword'),
            'password1.same' => trans('language.admin.users.password_asme'),
            'email.required' => trans('language.admin.users.enter_email'),
            'email.unique' => trans('language.admin.users.exits_email'),
            'email.email' => trans('language.admin.users.error_email'),
            'images.required' => trans('language.admin.users.enter_avatar'),
        ];
    }
}
