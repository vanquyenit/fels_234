<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function activities ()
    {
        return $this->hasMany(Activity::class);
    }

    public function relationships ()
    {
        return $this->hasMany(Relationship::class);
    }

    public function learneds ()
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

    public function scopeLogin($query, $email)
    {
        return $query->where('email', $email)->get();
    }

    public static function getFollow($id)
    {
        return User::where('id', '!=', $id)->whereNotIn('id', function($query){
            $query->select('follower_id')
            ->from(with(new Relationship)->getTable())
            ->where('following_id', Auth()->id());
        })->take(10)->get();
    }

    public function checkProvider($id)
    {
        return User::where('provider_id', $id)->first();
    }

    public function checkUsername($username)
    {
        return User::where('username', $username)->first();
    }

}
