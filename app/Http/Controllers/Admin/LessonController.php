<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\Course;
use App\Models\Word;
use App\Models\Learned;
use App\Models\WordAnswer;
use DB;

class LessonController extends Controller
{
    protected $lesson;
    protected $lessonWord;
    protected $course;
    protected $word;
    protected $learned;
    protected $wordAnswer;

    public function __construct(
        Lesson $lesson,
        Course $course,
        LessonWord $lessonWord,
        Word $word,
        Learned $learned,
        WordAnswer $wordAnswer
    ) {
        $this->lesson = $lesson;
        $this->lessonWord = $lessonWord;
        $this->course = $course;
        $this->word = $word;
        $this->learned = $learned;
        $this->wordAnswer = $wordAnswer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = $this->lesson->getList();
        $courses = $this->course->all();

        return view('admin.lesson.add', compact('lessons', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        $fileName = $request->file('image')->store('public');
        $image = md5(time()) . '' . explode('/', $fileName)[config('setting.admin')];

        Storage::move($fileName, 'public/' . $image);
        $arrLesson = [
            'name' => $request->name,
            'image' => $image,
            'course_id' => $request->course,
            'level' => $request->level,
        ];

        DB::beginTransaction();
        try {
            $lessonId = $this->lesson->create($arrLesson)->id;
            if ($lessonId) {
                foreach ($request->word as $key => $value) {
                    $meaningWord = $request->meaningWords[$key];
                    if ($value && $meaningWord) {
                        $arrWord = [
                            'content' => $value,
                        ];
                        $wordId =$this->word->create($arrWord)->id;
                        $arrWordAnswer = [
                            'content' => $meaningWord,
                            'word_id' => $wordId,
                            'correct' => config('setting.zero'),
                        ];
                        $arrLessonWord = [
                            'name' => $value,
                            'lesson_id' => $lessonId,
                            'word_id' => $wordId,
                            'word_answer_id' => $this->wordAnswer->create($arrWordAnswer)->id,
                        ];

                        if (empty($this->lessonWord->create($arrLessonWord))) {
                            return redirect()->action('Admin\LessonController@index')->with([
                                'flash_level' => trans('lesson.lessons.danger'),
                                'flash_messages' => trans('lesson.lessons.error'),
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->action('Admin\LessonController@index')->with([
                'flash_level' => trans('lesson.lessons.success'),
                'flash_messages' => trans('lesson.lessons.add_complete'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'flash_level' => trans('lesson.lessons.danger'),
                'flash_messages' => trans('lesson.lessons.error'),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->course->all();
        $joinLessons = $this->lesson->getLessonWord($id);

        return view('admin.lesson.edit', compact('id', 'course', 'joinLessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->word->updateWord($request->wordUpdate);
            $this->wordAnswer->updateWordAnswer($request->meaningWordUpdate);
            $words = $request->word;
            $meaningWords = $request->meaningWords;

            if (count($words) && count($meaningWords)) {
                foreach ($words as $key => $value) {
                    $meaningWord = $request->meaningWords[$key];

                    if ($value && $meaningWord) {
                        $arrWord = [
                            'content' => $value,
                        ];
                        $wordId = $this->word->create($arrWord)->id;
                        $arrWordAnswer = [
                            'content' => $meaningWord,
                            'word_id' => $wordId,
                            'correct' => config('setting.zero'),
                        ];
                        $arrLessonWord = [
                            'name' => $value,
                            'lesson_id' => $id,
                            'word_id' => $wordId,
                            'word_answer_id' => $this->wordAnswer->create($arrWordAnswer)->id,
                        ];

                        if (empty($this->lessonWord->create($arrLessonWord))) {
                            return redirect()->action('Admin\LessonController@index')->with([
                                'flash_level' => trans('lesson.lessons.danger'),
                                'flash_messages' => trans('lesson.lessons.error'),
                            ]);
                        }
                    }
                }
            }

            $lesson = $this->lesson->find($id);
            $image = $lesson->image;

            if ($request->hasFile('imageUpdate')) {
                Storage::delete('public/' . $lesson->image);
                $fileName = $request->file('imageUpdate')->store('public');
                $image = md5(time()) . '' . explode('/', $fileName)[config('setting.admin')];
                Storage::move($fileName, 'public/' . $image);
            }

            $lesson->name = $request->name;
            $lesson->image = $image;
            $lesson->course_id = $request->course;
            $lesson->level = $request->level;

            if ($lesson->save()) {
                DB::commit();

                return redirect()->action('Admin\LessonController@index')->with([
                    'flash_level' => trans('lesson.lessons.success'),
                    'flash_messages' => trans('lesson.lessons.edit_complete'),
                ]);
            } else {
                return redirect()->action('Admin\LessonController@index')->with([
                    'flash_level' => trans('lesson.lessons.danger'),
                    'flash_messages' => trans('lesson.lessons.error'),
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'flash_level' => trans('lesson.lessons.danger'),
                'flash_messages' => trans('lesson.lessons.error'),
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
        DB::beginTransaction();
        try {
            $lessonWord = $this->lessonWord->find($id);
            $lesson = $this->lesson->find($lessonWord->lesson_id);

            if ($this->learned->checkLessonWord($lessonWord->lesson_word_id)) {
                $word = $this->word->find($lessonWord->word_id);
                $wordAnswer = $this->wordAnswer->find($lessonWord->word_answer_id);
                $word->delete();
                $wordAnswer->delete();

                if ($this->lessonWord->getLessonWordCount($lessonWord->lesson_id) == config('setting.admin')) {
                    Storage::delete('public/' . $lesson->image);
                    $lesson->delete();
                    $lessonWord->delete();

                    return config('setting.admin');
                }

                $lessonWord->delete();
                DB::commit();

                return config('setting.zero');
            } else {
                return config('setting.member');
            }
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'flash_level' => trans('lesson.lessons.danger'),
                'flash_messages' => trans('lesson.lessons.error'),
            ]);
        }
    }

    public function postDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->ck_box as $key => $value) {
                if (count($this->lesson->getLessonInfo($value))) {
                    $lesson = $this->lesson->find($value);
                    $lessonWords = $this->lesson->find($value)->lessonWords;

                    foreach ($lessonWords as $key => $value) {
                        $wordId[] = $value->word_id;
                        $wordAnswerId[] = $value->word_answer_id;
                        $lessonWordId[] = $value->id;
                    }

                    $this->word->whereIn('id', $wordId)->delete();
                    $this->wordAnswer->whereIn('id', $wordAnswerId)->delete();
                    $this->lessonWord->whereIn('id', $lessonWordId)->delete();
                    Storage::delete('public/' . $lesson->image);
                    $lesson->delete($value);
                    DB::commit();
                } else {
                    return redirect()->action('Admin\LessonController@index')->with([
                        'flash_level' => trans('lesson.lessons.danger'),
                        'flash_messages' => trans('lesson.lessons.error'),
                    ]);
                }
            }

            return redirect()->action('Admin\LessonController@index')->with([
                'flash_level' => trans('lesson.lessons.success'),
                'flash_messages' => trans('lesson.lessons.delete_complete'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'flash_level' => trans('lesson.lessons.danger'),
                'flash_messages' => trans('lesson.lessons.error'),
            ]);
        }
    }
}
