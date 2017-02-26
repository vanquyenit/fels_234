<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|min:6|max:50|unique:users,username',
            'fullname' => 'required|min:5|max:30',
            'email' => 'required|email',
            'password' => 'required|min:6|max:50',
            'password_confirm' => 'required|same:password',
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
            'fullname.required' => trans('layout.regis.enter_fullname'),
            'fullname.min' => trans('layout.regis.min_fullname'),
            'fullname.max' => trans('layout.regis.max_fullname'),
            'username.required' => trans('layout.regis.enter_username'),
            'username.min' => trans('layout.regis.min_username'),
            'username.max' => trans('layout.regis.max_username'),
            'username.unique' => trans('layout.regis.exits_username'),
            'password.required' => trans('layout.regis.enter_password'),
            'password.min' => trans('layout.regis.min_pass'),
            'password.max' => trans('layout.regis.max_pass'),
            'password_confirm.required' => trans('layout.regis.enter_res_pasword'),
            'password_confirm.same' => trans('layout.regis.same'),
            'email.required' => trans('layout.regis.enter_email'),
            'email.email' => trans('layout.regis.error_email'),
        ];
    }
}
