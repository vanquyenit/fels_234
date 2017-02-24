<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotNewPasswordRequest extends FormRequest
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
            'password' => 'required|min:6|max:50',
            'password_confirm' => 'required|same:password',
            'email' => 'required|email',
            'code' => 'required'
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
            'password.required' => trans('forgotpassword.resetpassword.enter_password'),
            'password.min' => trans('forgotpassword.resetpassword.enter_password_min'),
            'password.max' => trans('forgotpassword.resetpassword.enter_password_max'),
            'password_confirm.required' => trans('forgotpassword.resetpassword.enter_res_pasword'),
            'password_confirm.same' => trans('forgotpassword.resetpassword.password_asme'),
            'email.required' => trans('forgotpassword.resetpassword.enter_email'),
            'email.email' => trans('forgotpassword.resetpassword.error_email'),
            'code.required' => trans('forgotpassword.resetpassword.enter_code'),
        ];
    }
    
}
