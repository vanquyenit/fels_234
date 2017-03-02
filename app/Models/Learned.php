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
        return $this->belongsTo(Course::class);
    }

    public function lesson ()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonWord ()
    {
        return $this->belongsTo(LessonWord::class);
    }

    public function getCourse($id_user)
    {
        $arLearn = Learned::with(['course' => function ($query) {
            $query->with(['lessons' => function ($query) {
                $query->with('lessonWords');
            }]);
        }])->select('*',DB::raw('count(learneds.course_id) as resutl'))
            ->where('user_id', $id_user)
            ->groupBy('learneds.course_id')
            ->get();
        foreach ($arLearn as $value) {
            $total =0;
            foreach ($value->course->lessons as $ab) {
                $total = $ab->lessonWords->count() + $total;
            }
            $arLearns[] = [
                'course_id' => $value->course_id,
                'course_name' => $value->course->name,
                'course_image' => $value->course->image,
                'course_describe' => $value->course->describe,
                'resutl' => $value->resutl,
                'total' => $total
            ];
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
            ->with('course')
            ->where('course_id', $id)
            ->where('user_id', $idUser)
            ->first();
    }

    public function getReview($id, $idUser)
    {
        return Learned::join('lesson_words', 'lesson_words.id', '=', 'learneds.lesson_word_id')
            ->join('words', 'words.id', '=', 'lesson_words.word_id')
            ->join('word_answers', 'word_answers.id', '=', 'lesson_words.word_answer_id')
            ->where('user_id', $idUser)->where('course_id', $id)->paginate(config('setting.review'));
    }
}
