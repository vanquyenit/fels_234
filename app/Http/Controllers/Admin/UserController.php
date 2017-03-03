<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Hash;
use Auth;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->GetUser();
        return view('admin.user.add', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $fileName  = $request->file('images')->store('public');
        $image = md5(time()) . '' . explode('/', $fileName)[config('setting.admin')];
        Storage::move($fileName, 'public/' . $avatar);
        $user = new $this->user();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->avatar = $avatar;
        $user->is_admin = config('setting.admin');
        if ($user->save()) {
            return redirect()->action('Admin\UserController@index')->with([
                'flash_level' => trans('language.admin.users.success'),
                'flash_messages' => trans('language.admin.users.add_complete'),
            ]);
        } else {
            return redirect()->action('Admin\UserController@index')->with([
                'flash_level' => trans('language.admin.users.danger'),
                'flash_messages' => trans('language.admin.users.error'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $userLogin = Auth::user()->id;

        if ($userLogin == $id) {
            $user = $this->user->find($id);
            $avatar = $user->avatar;

            if ($request->hasFile('imagesUpdate')) {
                Storage::delete('public/' . $user->avatar);
                $fileName  = $request->file('imagesUpdate')->store('public');
                $image = md5(time()) . '' . explode('/', $fileName)[config('setting.admin')];
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
                return redirect()->action('Admin\UserController@index')->with([
                    'flash_level' => trans('language.admin.users.success'),
                    'flash_messages' => trans('language.admin.users.edit_complete'),
                ]);
            } else {
                return redirect()->action('Admin\UserController@index')->with([
                    'flash_level' => trans('language.admin.users.danger'),
                    'flash_messages' => trans('language.admin.users.error'),
                ]);
            }
        } else {
            return redirect()->action('Admin\UserController@index')->with([
                'flash_level' => trans('language.admin.users.danger'),
                'flash_messages' => trans('language.admin.users.no_edit_user'),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postDelete(Request $request)
    {
        $userLogin = Auth::user()->id;

        if ($userLogin == config('setting.admin')) {
            foreach ($request->ck_box as $key => $value) {

                if ($value != config('setting.admin')) {
                    $isId = $this->user->checkUser($value);

                    if ($isId > config('setting.zero')) {
                        $user = $this->user->find($value);
                        Storage::delete('public/' . $user->avatar);
                        $user->delete($value);
                    } else {
                        return redirect()->action('Admin\UserController@index')->with([
                            'flash_level' => trans('language.admin.users.danger'),
                            'flash_messages' => trans('language.admin.users.delete_fail'),
                        ]);
                    }
                }
            }

            return redirect()->action('Admin\UserController@index')->with([
                'flash_level' => trans('language.admin.users.success'),
                'flash_messages' => trans('language.admin.users.delete_complete'),
            ]);
        } else {
            return redirect()->action('Admin\UserController@index')->with([
                'flash_level' => trans('language.admin.users.danger'),
                'flash_messages' => trans('language.admin.users.no_delete_user'),
            ]);
        }
    }

    public function getMember()
    {
        $user = $this->user->member();
        return view('admin.user.member', compact('user'));
    }
}
