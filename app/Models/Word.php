<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';

    protected $fillable = ['content','category_id'];

    public $timestamps = true;

    public function lessonword () 
    {
        return $this->hasMany('App\Models\LessonWord');
    }

    public function category () 
    {
        return $this->belongTo('App\Models\Category');
    }

    public function wordanswer () 
    {
        return $this->hasMany('App\Models\WordAnswer');
    }

    public function learned () 
    {
        return $this->hasMany('App\Models\Learned');
    }
}
