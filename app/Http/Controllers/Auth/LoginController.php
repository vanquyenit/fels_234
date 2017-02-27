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
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->user = $user;
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

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = $this->user->Login($email);
        if (count($user) == 0) {
            return redirect()->action('IndexController@index')
                ->with(['result' => trans('layout.not_register')]);
        } else if (Auth::attempt(
            [
                'email' => $email,
                'password' => $password,
                'is_admin' => config('setting.member'),
            ]))
        {
            return redirect()->action('IndexController@home');
        } else {
            return redirect()->action('IndexController@index')
                ->with(['result' => trans('layout.fail')]);
        }

    }
}
