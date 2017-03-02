<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Lesson;
use App\Models\Word;
use App\Models\LessonWord;
use App\Models\Learned;
use Session;
use Auth;

class LearnController extends Controller
{

    protected $learned;
    protected $lesson;
    protected $lessonWord;

    function __construct(
        Lesson $lesson,
        LessonWord $lessonWord,
        Learned $learned
    ) {
        $this->lessonWord = $lessonWord;
        $this->lesson = $lesson;
        $this->learned = $learned;
    }

    public function deleteCourse()
    {
        if (Request::ajax()) {
            DB::beginTransaction();
            try {
                $id = Request::get('id');
                $arLearn = Learned::where('user_id', Auth::user()->id)
                ->where('course_id', $id)->get();

                foreach ($arLearn as $value) {
                    $arDel[] = $value->id;
                }
                Learned::whereIn('id', $arDel)->delete();
                DB::commit();

                return config('setting.zero');
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
    }
}
