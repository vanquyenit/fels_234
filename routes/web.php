<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function() {
    Route::get('login', [
        'as' => 'auth.getLoginAdmin',
        'uses' => 'LoginController@getLoginAdmin',
    ]);
    Route::post('login', [
        'as' => 'auth.postLoginAdmin',
        'uses' => 'LoginController@postLoginAdmin',
    ]);
    Route::get('logout', [
        'as' => 'auth.getLogoutAdmin', function() {
            Auth::logout();
            return redirect()->route('auth.getLoginAdmin');
        }
    ]);
    Route::get('forgot', [
        'as' => 'auth.getForgotPassword',
        'uses' => 'ForgotPasswordController@getForgotPassword',
    ]);
    Route::post('forgot', [
        'as' => 'auth.postForgotPassword',
        'uses' => 'ForgotPasswordController@postForgotPassword',
    ]);
    Route::get('newpass', [
        'as' => 'auth.getForgotNewPassword',
        'uses' => 'ForgotPasswordController@getForgotNewPassword',
    ]);
    Route::post('newpass', [
        'as' => 'auth.postForgotNewPassword',
        'uses' => 'ForgotPasswordController@postForgotNewPassword',
    ]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {

    Route::resource('index', 'IndexController');
    Route::resource('/', 'IndexController');

    Route::resource('category', 'CategoryController');
    Route::post('category/delete', [
        'as' => 'admin.category.postDelete',
        'uses' => 'CategoryController@postDelete',
    ]);

    Route::get('user/member', [
        'as' => 'admin.user.getMember',
        'uses' => 'UserController@getMember',
    ]);
    Route::resource('user', 'UserController');
    Route::post('user/delete', [
        'as' => 'admin.user.postDelete',
        'uses' => 'UserController@postDelete',
    ]);

    Route::resource('lesson', 'LessonController');
    Route::post('lesson/delete', [
        'as' => 'admin.lesson.postDelete',
        'uses' => 'LessonController@postDelete',
    ]);

    Route::resource('course', 'CourseController');
    Route::post('course/delete', [
        'as' => 'admin.course.postDelete',
        'uses' => 'CourseController@postDelete',
    ]);

});
