<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'image',
        'course_id',
        'level',
    ];

    public $timestamps = true;


    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function learneds()
    {
        return $this->hasMany(Learned::class);
    }

    public function getList()
    {
        return Lesson::with('course')->orderBy('created_at', 'desc')->get();
    }

    public function checkLesson($id)
    {
        return Lesson::where('course_id', $id)->count();
    }

    public function getAllVocabulary($id)
    {
        return Lesson::join('lesson_words', 'lessons.id', '=', 'lesson_words.lesson_id')
            ->where('lessons.course_id', $id)
            ->count();
    }

    public function getFirstLesson($id)
    {
        return Lesson::where('course_id', $id)->first()->level;
    }

    public function getLessonInfo($id)
    {
        return Lesson::find($id);
    }

    public function getLessonWord($id)
    {
        return Lesson::with(['lessonWords' => function ($query) {
            $query->with('word', 'wordAnswer');
        }])->where('lessons.id', $id)->first();
    }
}
