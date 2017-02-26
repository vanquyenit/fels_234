<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Learned extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'lesson_word_id',
        'correct',
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

    public function getCourse($id_user)
    {
        $arLearn = Learned::select('*',DB::raw('count(learneds.course_id) as number'))
        ->join('courses', 'courses.id', '=', 'learneds.course_id')
        ->groupBy('learneds.course_id')
        ->where('user_id', $id_user)
        ->get();
        if (count($arLearn) > 0) {
            foreach($arLearn as $key => $value)
            {
                $countLesson = Lesson::with('lesson_words')
                    ->where('lessons.course_id', $value->course_id)
                    ->count();
                $arLearns[] = [
                    'course_id' => $value->course_id,
                    'course_name' => $value->name,
                    'course_image' => $value->image,
                    'course_describe' => $value->describe,
                    'resutl' => $value->number,
                    'total' => $countLesson,
                ];
            }
        } else {
            $arLearns = [];
        }
        return $arLearns;
    }

    public function getScores($idUser)
    {
        return Learned::select(DB::raw('COUNT(correct) as total,SUM(correct) as correct'))
            ->where('user_id', $idUser)->first();
    }

    public function getMemberLearn($id)
    {
        return Learned::where('course_id', $id)
            ->groupBy('user_id')->get();
    }

    public function getUserLearnLesson($id, $idUser)
    {
        return Learned::where('course_id', $id)
            ->where('user_id', $idUser)
            ->first();
    }

    public function getLearn($id, $idUser)
    {
        return Learned::with('lesson_words')
            ->where(['lesson_id' => $id, 'user_id' => $idUser ])
            ->count();
    }

    public function getLearnOfCourse($id, $idUser)
    {
        return Learned::select(DB::raw('count(learneds.course_id) as number'))
            ->with('courses')
            ->where('course_id', $id)
            ->where('user_id', $idUser)
            ->first();
    }

    public function getReview($id, $idUser)
    {
        return Learned::where('user_id', $idUser)->where('course_id', $id)->paginate(10);
    }
}
