<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Relationship;
use App\Models\User;
use App\Models\Learned;
use App\Models\Lesson;
use Auth;
use App\Http\Requests\ChangePassRequest;

class UserController extends Controller
{
    /**
     * Following with member orther
     *
     * @param $idUser follower, $idUser following
     *
     * @return void
     */
    protected $Learned;
    protected $lesson;
    protected $user;
    protected $relationship;

    public function __construct(
        Learned $learned,
        Lesson $lesson,
        User $user,
        Relationship $relationship
    ) {
        $this->learned = $learned;
        $this->lesson = $lesson;
        $this->user = $user;
        $this->relationship = $relationship;
    }

    public function following()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $follow = Request::get('follow');
            $checkUser = $this->relationship->checkFollow($id);

            if ($checkUser) {
                Relationship::find($checkUser->id)->delete();
                return config('setting.zero');
            } else {
                $Follow = new Relationship;
                $Follow->following_id = Auth::user()->id;
                $Follow->follower_id = $id;
                $Follow->save();
                return config('setting.admin');
            }
        }

    }

    /**
     * Following with member orther
     *
     * @param $idUser follower, $idUser following
     *
     * @return void
     */
    public function index($username)
    {
        $arUser = User::where('username', $username)->first();
        $idUser = $arUser->id;
        $arFollower = $this->user->getFollower($idUser);
        $arFollowing = $this->user->getFollowing($idUser);
        $arLearns = $this->learned->getCourse($idUser);
        if (count($arUser)) {
            return view('user.index', compact('arUser', 'arFollowing', 'arFollower','arLearns'));
        } else {
            return redirect()->action('IndexController@index')
                ->with(['result' => trans('layout.notsearch')]);
        }
    }

    public function setting()
    {
        $id_user = Auth::user()->id;
        $arUser = User::find($id_user);
        return view('user.setting', compact('arUser'));
    }

    public function changePass(ChangePassRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->password = bcrypt(trim($request->password));
        if ($user->save()){
            return redirect()->action('UserController@changePass')
                ->with(['result' => trans('layout.profiles.success')]);
        } else {
            return redirect()->action('UserController@changePass')
                ->with(['result' => trans('layout.profiles.error')]);
        }

    }
}
