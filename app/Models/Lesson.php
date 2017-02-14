<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	protected $table = 'lessons';

    protected $fillable = ['name','image','user_id','category_id','result'];

    public $timestamps = true;
    
    public function user () 
    {
        return $this->belongTo('App\Models\User');
    }

    public function lessonword () 
    {
        return $this->hasMany('App\Models\LessonWord');
    }

    public function category () 
    {
        return $this->belongTo('App\Models\Category');
    }
}
