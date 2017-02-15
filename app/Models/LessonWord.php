<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonWord extends Model
{
    protected $fillable = [
        'name',
        'lesson_id',
        'word_id',
        'wordanswer_id',
    ];

    public $timestamps = true;
    
    public function lesson () 
    {
        return $this->belongTo(Lesson::class);
    }

    public function word () 
    {
        return $this->belongTo(Word::class);
    }

    public function wordanswer () 
    {
        return $this->belongTo(WordAnswer::class);
    }
}
