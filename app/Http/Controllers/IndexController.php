<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Learned;
use App\Models\User;
use DB;
use Session;
use Illuminate\Database\Query\Builder;

class IndexController extends Controller
{
    protected $course;
    protected $learned;
    protected $user;

    public function __construct(
        Course $course,
        Learned $learned,
        User $user
    ) {
        $this->course = $course;
        $this->learned = $learned;
        $this->user = $user;
    }

    public function index()
    {
        if (Auth::user()) {
            return redirect('home');
        }
        $arCategory = $this->course->getCat();
        return view('index.index', compact('arCategory'));
    }

    public function home()
    {
        $idUser = Auth()->id();
        $arCourse = $this->learned->getScores($idUser);
        Session::put('arCourse', $arCourse );
        $arLearns = $this->learned->getCourse($idUser);
        $arRelationship = $this->user->getFollow($idUser);
        return view('index.home', compact('arLearns', 'arRelationship'));
    }
}
