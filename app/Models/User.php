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
        'is_admin', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token'  
    ];

    public function lessons () 
    {
        return $this->hasMany(Lesson::class);
    }

    public function activitys () 
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
}
