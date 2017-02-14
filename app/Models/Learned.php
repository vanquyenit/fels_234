<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learned extends Model
{
    protected $table = 'learneds';

    protected $fillable = ['user_id','word_id'];

    public $timestamps = true;
    
    public function user () 
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function word () 
    {
        return $this->belongsToMany('App\Models\Word');
    }
}
