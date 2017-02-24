<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email.required' => trans('forgotpassword.forgot.enter_email'),
            'email.email' => trans('forgotpassword.forgot.error_email'),
        ];
    }
    
}
