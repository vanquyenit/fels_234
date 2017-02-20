<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonWord extends Model
{
    protected $fillable = [
        'name',
        'lesson_id',
        'word_id',
        'word_answer_id'
    ];

    public $timestamps = true;

    public function lesson ()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function word ()
    {
        return $this->belongsTo(Word::class);
    }

    public function wordAnswer ()
    {
        return $this->belongsTo(WordAnswer::class);
    }

    public function learneds ()
    {
        return $this->hasMany(Learned::class);
    }
}
