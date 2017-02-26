<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;

class CategoryController extends Controller
{
    protected $category;
    protected $course;

    public function __construct(Category $category, Course $course)
    {
        $this->category = $category;
        $this->course = $course;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categories = $this->category->orderBy('id', 'DESC')->get();
         return view('admin.category.add', compact('categories'));
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
    public function store(CategoryRequest $request)
    {
        $category = new $this->category();
        $category->name = $request->name;
        if ($category->save()) {
            return redirect()->action('Admin\CategoryController@index')->with([
                'flash_level' => trans('category.cate.success'),
                'flash_messages' => trans('category.cate.add_complete'),
            ]);
        } else {
            return redirect()->action('Admin\CategoryController@index')->with([
                'flash_level' => trans('category.cate.danger'),
                'flash_messages' => trans('category.cate.error'),
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
        $category = $this->category->findOrFail($id);
        return view('admin.category.edit', compact('category'));
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
        $category = $this->category->find($id);
        $category->name = $request->name;
        $category->save();
        if ($category->save()) {
            return redirect()->action('Admin\CategoryController@index')->with([
                'flash_level' => trans('category.cate.success'),
                'flash_messages' => trans('category.cate.edit_complete'),
            ]);
        } else {
            return redirect()->action('Admin\CategoryController@index')->with([
                'flash_level' => trans('category.cate.danger'),
                'flash_messages' => trans('category.cate.error'),
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
            $checkCourse = $this->course->where('category_id', $value)->count();

            if ($checkCourse == 0) {
                $isId = $this->category->where('id', $value)->count();

                if ($isId > 0) {
                    $category = $this->category->find($value);
                    $category->delete($value);
                } else {
                    return redirect()->action('Admin\CategoryController@index')->with([
                        'flash_level' => trans('category.cate.danger'),
                        'flash_messages' => trans('category.cate.delete_fail'),
                    ]);
                }
            } else {
                return redirect()->action('Admin\CategoryController@index')->with([
                    'flash_level' => trans('category.cate.danger'),
                    'flash_messages' => trans('category.cate.not_delete'),
                ]);
            }
        }

        return redirect()->action('Admin\CategoryController@index')->with([
            'flash_level' => trans('category.cate.success'),
            'flash_messages' => trans('category.cate.delete_complete'),
        ]);
    }
}
