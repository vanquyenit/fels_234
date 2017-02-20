<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Word extends Model
{
    protected $fillable = [
        'content',
    ];

    public $timestamps = true;

    public function lessonWords ()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function wordAnswers ()
    {
        return $this->hasMany(WordAnswer::class);
    }
}
