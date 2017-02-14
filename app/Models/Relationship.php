<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
        'following', 
        'follower', 
    ];

    public $timestamps = true;
    
    public function users () 
    {
        return $this->hasMany(User::class);
    }
}
