<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learned extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public $timestamps = true;

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function course ()
    {
        return $this->belongsTo(Word::class);
    }

    public function lesson ()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonWord ()
    {
        return $this->belongsTo(Lesson::class);
    }
}
