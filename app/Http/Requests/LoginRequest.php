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
        return [
            'username' => 'required',
            'password' => 'required',
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
            'username.required' => trans('login.login.enter_username'),
            'password.required' => trans('login.login.enter_password'),
        ];
    }
    
}
