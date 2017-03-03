<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request1;
use Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use App\Models\Relationship;
use App\Models\User;
use App\Models\Learned;
use App\Models\Lesson;
use App\Models\Activity;
use Auth;
use DB;
use Hash;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\UserUpdateRequest;

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
            $username = Request::get('username');
            $checkUser = $this->relationship->checkFollow($id);
            DB::beginTransaction();
            try {
                if ($checkUser) {
                    Relationship::find($checkUser->id)->delete();
                    DB::commit();

                    return config('setting.zero');
                } else {
                    $activity = new Activity;
                    $activity->scores = $id;
                    $activity->user_id = Auth::user()->id;
                    $activity->action_type = trans('layout.followuser') . $username;
                    $activity->save();
                    $Follow = new Relationship;
                    $Follow->following_id = Auth::user()->id;
                    $Follow->follower_id = $id;
                    $Follow->save();
                    DB::commit();

                    return config('setting.admin');
                }
            } catch (Exception $e) {
                DB::rollBack();

                return redirect()->back()->withErrors([
                    'flash_level' => trans('lesson.lessons.danger'),
                    'flash_messages' => trans('lesson.lessons.error'),
                ]);
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
        if (count($arUser)) {
            $arFollower = $this->user->getFollower($arUser->id);
            $arFollowing = $this->user->getFollowing($arUser->id);
            $arLearns = $this->learned->getCourse($arUser->id);
            $activity = $this->user->getActivity($arUser->id);

            return view('user.index', compact('arUser', 'activity', 'arFollowing', 'arFollower', 'arLearns'));
        } else {
            return redirect()->action('IndexController@index')->with(['result' => trans('layout.notsearch')]);
        }
    }

    public function updateUser(UserUpdateRequest $request, $id)
    {
        $user = $this->user->find($id);
        $avatar = $user->avatar;
        DB::beginTransaction();
        try {
            if ($request->hasFile('imagesUpdate')) {
                Storage::delete('public/' . $user->avatar);
                $fileName  = $request->file('imagesUpdate')->store('public');
                $avatar = md5(time()) . '' . explode('/', $fileName)[config('setting.admin')];
                Storage::move($fileName, 'public/' . $avatar);
            }

            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->avatar = $avatar;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            if ($user->save()) {
                DB::commit();

                return redirect()->back()->with([
                    'flash_level' => trans('language.admin.users.success'),
                    'flash_messages' => trans('language.admin.users.edit_complete'),
                ]);
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'flash_level' => trans('lesson.lessons.danger'),
                'flash_messages' => trans('lesson.lessons.error'),
            ]);
        }
    }
}
