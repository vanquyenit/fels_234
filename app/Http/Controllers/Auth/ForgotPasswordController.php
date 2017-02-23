<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ForgotNewPasswordRequest;
use App\Models\User;
use Session;
use Mail;
use Hash;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getForgotPassword()
    {
        return view('admin.user.forgotpass');
    }

    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->email;
        $code = rand(10000, 99999);
        if (count(User::checkMail($email)) > 0) {
            Session::put('key', $code );
            $data['code'] = Session::get('key');
            $arrMail = [
                'url' => "admin.user.sendmail",
                'data' => $data,
                'email_to' => $email,
                'email_form' => config('setting.email'),
                'subject' => trans('language.admin.forgot.confirmation_email'),
                'from' => trans('language.admin.forgot.elearning'),
                'to' => trans('language.admin.forgot.elearning'),
            ];
            if (getMail($arrMail) == null) {
                return redirect()->action('Auth\ForgotPasswordController@getForgotNewPassword')->with([
                    'flash_level' => trans('language.admin.forgot.success'),
                    'flash_messages' => trans('language.admin.forgot.receive_code'),
                ]);
            } else {
                return redirect()->action('Auth\ForgotPasswordController@getForgotPassword')->with([
                    'flash_level' => trans('language.admin.forgot.danger'),
                    'flash_messages' => trans('language.admin.forgot.error'),
                ]);
            }
        }

        return redirect()->action('Auth\ForgotPasswordController@getForgotPassword')->with([
            'flash_level' => trans('language.admin.forgot.danger'),
            'flash_messages' => trans('language.admin.forgot.no_email'),
        ]);
    }

    public function getForgotNewPassword()
    {
        return view('admin.user.newpassword');
    }

    public function postForgotNewPassword(ForgotNewPasswordRequest $request)
    {
        $code = Session::get('key');
        if ($code == $request->code) {
            $users = User::checkMail($request->email);
            if (count($users) > 0) {
                $user = User::find($users[0]->id);
                $user->password = Hash::make($request->password);
                $user->save();
                $login = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'is_admin' => config('setting.admin'),
                ];
                if (Auth::attempt($login)) {
                    return redirect()->action('Admin\IndexController@index');
                } else {
                    return redirect()->action('Auth\LoginController@getLoginAdmin')->with([
                        'flash_level' => trans('language.admin.forgot.danger'),
                        'flash_messages' => trans('language.admin.forgot.checklogin'),
                    ]);
                }
            } else {
                return redirect()->action('Auth\ForgotPasswordController@getForgotNewPassword')->with([
                    'flash_level' => trans('language.admin.forgot.danger'),
                    'flash_messages' => trans('language.admin.forgot.no_email'),
                ]);
            }
        } else {
            return redirect()->action('Auth\ForgotPasswordController@getForgotNewPassword')->with([
                'flash_level' => trans('language.admin.forgot.danger'),
                'flash_messages' => trans('language.admin.forgot.error_code'),
            ]);
        }
    }
}
