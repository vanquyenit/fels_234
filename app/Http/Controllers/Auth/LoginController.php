<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Socialite;
use Auth;
use Hash;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = './auth/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLoginAdmin()
    {
        return view('admin.user.login');
    }

    public function postLoginAdmin(LoginRequest $request)
    {
        $login = [
            'username' => $request->username,
            'password' => $request->password,
            'is_admin' => config('setting.admin'),
        ];

        if (Auth::attempt($login)) {
            return redirect()->action('Admin\IndexController@index');
        } else {
            return redirect()->action('Auth\LoginController@getLoginAdmin')->with([
                'flash_level' => trans('login.login.danger'),
                'flash_messages' => trans('login.login.checklogin'),
            ]);
        }
    }
}
