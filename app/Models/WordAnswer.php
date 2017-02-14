<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordAnswer extends Model
{
    protected $table = 'word_answers';

    protected $fillable = ['content','corect','word_id'];

    public $timestamps = true;

    public function lessonword () 
    {
        return $this->hasMany('App\Models\LessonWord');
    }

    public function word () 
    {
        return $this->belongTo('App\Models\Word');
    }
}
