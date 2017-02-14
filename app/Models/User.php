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
        'username','fullname', 'email', 'password','avatar','is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lesson () 
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function activity () 
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function relationship () 
    {
        return $this->hasMany('App\Models\Relationship');
    }

    public function learned () 
    {
        return $this->hasMany('App\Models\Learned');
    }
}
