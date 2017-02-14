<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonWord extends Model
{
    protected $table = 'lesson_words';

    protected $fillable = ['name','lesson_id','word_id','wordanswer_id'];

    public $timestamps = true;
    
    public function lesson () 
    {
        return $this->belongTo('App\Models\Lesson');
    }

    public function word () 
    {
        return $this->belongTo('App\Models\Word');
    }

    public function wordanswer () 
    {
        return $this->belongTo('App\Models\WordAnswer');
    }
}
