<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = 'relationships';

    protected $fillable = ['following','follower'];

    public $timestamps = true;
    
    public function user () 
    {
        return $this->belongsToMany('App\Models\User');
    }
}
