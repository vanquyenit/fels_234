<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use Socialite;
use Auth;
use Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function postRegister(RegisterRequest $request)
    {

        $register = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'avatar' => trans('layout.avatar'),
            'is_admin' => config('setting.member'),
        ]);
        if ($register){
            return redirect()->action('IndexController@index')->with(['result' => trans('layout.regis.success')]);
        } else {
            return redirect()->action('IndexController@index')->with(['result' => trans('layout.regis.error')]);
        }

    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $socialProvider = $this->user->checkProvider($socialUser->getId());
        if (!$socialProvider) {
            if ($socialUser->getEmail()) {
                $username = explode('@', $socialUser->getEmail())[0];
                $checkUser = $this->user->checkUsername($username);
                if ($checkUser > 0) {
                    $username = $username . '_' . rand(0, 99);
                }
            } else {
                $username = $socialUser->getId();
            }

            $img = file_get_contents($socialUser->avatar_original);
            $file = storage_path() . '/app/public/' . $socialUser->getId() . '.jpg';
            file_put_contents($file, $img);
            $user = $this->user->firstOrCreate(
                [
                'provider_id' => $socialUser->getId(),
                'username' => $username,
                'password' => bcrypt(rand(1000, 99999)),
                'fullname' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'avatar' => $socialUser->getId() . '.jpg',
                'is_admin' => config('setting.member'),
                ]
            );
        } else {
            $user = $socialProvider;
        }

        auth()->login($user);
        return redirect()->action('IndexController@home');
    }
}
