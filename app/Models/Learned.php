<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learned extends Model
{
    protected $fillable = [
        'user_id', 
        'word_id', 
    ];

    public $timestamps = true;
    
    public function users () 
    {
        return $this->hasMany(User::class);
    }

    public function words () 
    {
        return $this->hasMany(Word::class);
    }
}
