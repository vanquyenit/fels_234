<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Learned;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\LessonWord;
use App\Models\WordAnswer;
use Auth;

class CourseController extends Controller
{
    protected $lessonWord;
    protected $Learned;
    protected $WordAnswer;
    protected $Lesson;
    protected $Category;
    protected $Course;

    public function __construct(
        LessonWord $lessonWord,
        Learned $learned,
        WordAnswer $wordAnswer,
        Lesson $lesson,
        Category $category,
        Course $course
    ) {
        $this->lessonWord = $lessonWord;
        $this->learned = $learned;
        $this->wordAnswer = $wordAnswer;
        $this->lesson = $lesson;
        $this->category = $category;
        $this->course = $course;
    }

    public function view($id = null)
    {
        if (!$id) {
            $id = $this->course->getCat()[0]->category_id;
        }

        $arCourse = $this->category->getCourse($id);
        $arTotal = [];

        if ($arCourse) {
            if (count($arCourse->courses) > 0) {
                foreach ($arCourse->courses as $key => $value) {
                    $count = $this->learned->getMemberLearn($value->id);
                    $arTotal[] = [
                        'id' => $value->id,
                        'cat' => $arCourse->name,
                        'name' => $value->name,
                        'image' => $value->image,
                        'total' => count($count),
                    ];
                }
            } else {
                return redirect()->action('IndexController@index')->with(['result' => trans('layout.notsearch')]);
            }
        } else {
            return redirect()->action('IndexController@index')->with(['result' => trans('layout.notsearch')]);
        }

        $arCat = $this->category->all();
        return view('course.index', compact('arTotal', 'arCat'));
    }

    public function course($id, $slug)
    {
        $idUser = Auth()->id();
        $arCourse = $this->course->getLesson($id);
        $arUserLearn = $this->learned->getUserLearnLesson($id, $idUser);    //get user learned how lesson

        if ($arUserLearn) {
            $reviewLesson = $arUserLearn->lesson_id;
        } else {
            $reviewLesson = $this->lesson->getFirstLesson($id);
        }

        foreach ($arCourse->lessons as $key => $value) {
            $totalNumber = $this->lessonWord->totalNumber($value->id);      // Get total number of questions of a lesson
            $learned = $this->learned->getLearn($value->id, $idUser);       // Get all questions of a lesson learned
            $arCourse['lessons'][$key]['all'] = $totalNumber;                // Push a array $arCourse
            $arCourse['lessons'][$key]['learned'] = $learned;
        }

        $arLearn = $this->learned->getLearnOfCourse($id, $idUser);         // Check the user has learned or not
        $countVocabulary = $this->lesson->getAllVocabulary($id);           // Count the total vocabulary of a lesson
        $arLearns = [
            'resutl' => $arLearn->number,
            'total' => $countVocabulary,
            'percent' => ($arLearn->number/$countVocabulary) * 100,
        ];

        if (count($arCourse) > 0) {
            return view('course.lesson', compact('arCourse', 'arLearns', 'reviewLesson'));
        } else {
            return redirect()->action('IndexController@index')->with(['result' => trans('layout.notsearch')]);
        }

    }

    public function review($id)
    {
        $idUser = Auth()->id();
        $getReview = $this->learned->getReview($id, $idUser);
        foreach ($getReview as $key => $value) {
            $Lesson = $this->lessonWord->getVocabuary($value->lesson_word_id) ;
            $arReview[] = [
                'word' => $Lesson['word']['content'],
                'word_answer' => $Lesson['wordAnswer']['content'],
            ];
        }
        return view('course.review', compact('arReview', 'getReview'));
    }

}

