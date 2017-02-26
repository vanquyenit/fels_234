<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;

class CourseController extends Controller
{
    protected $category;
    protected $course;
    protected $lesson;

    public function __construct(Category $category, Course $course, Lesson $lesson)
    {
        $this->category = $category;
        $this->lesson = $lesson;
        $this->course = $course;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = $this->course->getList();
        $categories = $this->category->all();
        return view('admin.course.add', compact('course', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $fileName = $request->file('image')->store('public');
        $time = md5(time());
        $imageNew = 'image' .$time . '.jpg';
        Storage::move($fileName, 'public/' . $imageNew);
        $course = new Course();
        $course->name = $request->name;
        $course->image = $imageNew;
        $course->category_id = $request->category;
        $course->describe = $request->describe;

        if ($course->save()) {
            return redirect()->action('Admin\CourseController@index')->with([
                'flash_level' => trans('course.courses.success'),
                'flash_messages' => trans('course.courses.add_complete'),
            ]);
        } else {
            return redirect()->action('Admin\CourseController@index')->with([
                'flash_level' => trans('course.courses.danger'),
                'flash_messages' => trans('course.courses.error'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courseEdit = $this->course->findOrFail($id);
        $categories = $this->category->all();
        return view('admin.course.edit', compact('courseEdit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = $this->course->find($id);
        $imageNew = $course->image;

        if ($request->hasFile('imageEdit')) {
            if (!empty($imageNew)) {
                Storage::delete('public/' . $course->image);
            }
            $fileName = $request->file('imageEdit')->store('public');
            $time = md5(time());
            $imageNew = 'image' . $time . '.jpg';
            Storage::move($fileName, 'public/' . $imageNew);
        }

        $course->name = $request->name;
        $course->image = $imageNew;
        $course->category_id = $request->category;
        $course->describe = $request->describe;

        if ($course->save()) {
            return redirect()->action('Admin\CourseController@index')->with([
                'flash_level' => trans('course.courses.success'),
                'flash_messages' => trans('course.courses.edit_complete'),
            ]);
        } else {
            return redirect()->action('Admin\CourseController@index')->with([
                'flash_level' => trans('course.courses.danger'),
                'flash_messages' => trans('course.courses.error'),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postDelete(Request $request)
    {
        foreach ($request->ck_box as $key => $value) {
            $checkCourse = $this->lesson->checkLesson($value);
            if ($checkCourse == 0) {
                $count = $this->course->checkCourse($value);
                if ($count > 0) {
                    $course = $this->course->find($value);
                    Storage::delete('public/' . $course->image);
                    $course->delete($value);
                } else {
                    return redirect()->action('Admin\CourseController@index')->with([
                        'flash_level' => trans('course.courses.danger'),
                        'flash_messages' => trans('course.courses.delete_fail'),
                    ]);
                }
            } else {
                return redirect()->action('Admin\CourseController@index')->with([
                    'flash_level' => trans('course.courses.danger'),
                    'flash_messages' => trans('course.courses.not_delete_couse'),
                ]);
            }
        }

        return redirect()->action('Admin\CourseController@index')->with([
            'flash_level' => trans('course.courses.success'),
            'flash_messages' => trans('course.courses.delete_complete'),
        ]);
    }
}
