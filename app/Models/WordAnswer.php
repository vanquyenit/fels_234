<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordAnswer extends Model
{
    protected $fillable = [
        'content', 
        'corect', 
        'word_id', 
    ];

    public $timestamps = true;

    public function lessonwords () 
    {
        return $this->hasMany(LessonWord::class);
    }

    public function word () 
    {
        return $this->belongTo(Word::class);
    }
}
