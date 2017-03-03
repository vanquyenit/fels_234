<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'avatar',
        'provider_id',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function relationships()
    {
        return $this->hasMany(Relationship::class);
    }

    public function learneds()
    {
        return $this->hasMany(Learned::class);
    }

    public static function checkMail($input)
    {
        return User::where('email', $input)->get();
    }

    public function member()
    {
        return  User::where('is_admin', config('setting.member'))->orderBy('id', 'DESC')->get();
    }

    public function checkUser($input)
    {
        return User::where('id', $input)->count();
    }

    public function scopeGetUser($query)
    {
        return $query->where('is_admin', config('setting.admin'))->orderBy('id', 'DESC')->get();
    }

    public function checkRegister($email)
    {
        return User::where('email', $email)->first();
    }

    public static function getFollow($id)
    {
        $whereData = [
            ['is_admin', config('setting.member')],
            ['id', '<>', $id]
        ];

        return User::where($whereData)
            ->whereNotIn('id', function ($query) {
                $query->select('follower_id')
                ->from('relationships')
                ->where('following_id', Auth::user()->id);
            })->take(config('setting.following'))->get();
    }

    public function checkProvider($id)
    {
        return User::where('provider_id', $id)->first();
    }

    public function checkUsername($username)
    {
        return User::where('username', $username)->first();
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function getFollower($idUser)
    {
        return User::where('id', '!=', $idUser)
            ->where('is_admin', config('setting.member'))
            ->whereIn('id', function ($query) {
                $query->select('follower_id')
                ->from('relationships')
                ->where('following_id', Auth::user()->id);
            })->get();
    }

    public function getFollowing($idUser)
    {
        return User::where('is_admin', config('setting.member'))
            ->whereIn('id', function ($query) {
                $query->select('following_id')
                ->from('relationships')
                ->where('follower_id', Auth::user()->id);
            })->get();
    }

    public function getActivity($id)
    {
        return User::with(['activities' => function ($query) {
            $query->orderBy('id', 'DESC')->paginate(config('setting.review'));
        }])->where('id', $id)->first();
    }
}
