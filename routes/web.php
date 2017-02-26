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
Route::pattern('id', '[0-9]+');
Route::pattern('id_lesson', '[0-9]+');
Route::pattern('slug', '.+');

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

Route::get('/', [
    'as'=>'index.index',
    'uses'=>'IndexController@index',
]);
Route::group(['middleware' => 'auth'],function(){
    Route::get('home', [
        'as'=>'index.home',
        'uses'=>'IndexController@home',
    ]);
    Route::get('home', [
        'as'=>'user.setting',
        'uses'=>'IndexController@home',
    ]);
    Route::post('following', [
        'as'=>'member.following',
        'uses'=>'UserController@following',
    ]);
    Route::get('users/{slug}', [
        'as'=>'users.index',
        'uses'=>'UserController@index',
    ]);
    Route::get('courses/{value?}', [
        'as'=>'course.index',
        'uses'=>'CourseController@index',
    ]);
    Route::get('courses/{id}/{content}', [
        'as'=>'course.course',
        'uses'=>'CourseController@course',
    ]);
    Route::get('courses/{id}/{content}/{action}', [
        'as'=>'course.learned',
        'uses'=>'CourseController@learned',
    ]);
});
Route::get('provider/{provider}',[
    'as' => 'auth.provider.login',
    'uses' => 'Auth\RegisterController@redirectToProvider',
]);
Route::get('provider/{provider}/callback',[
    'as' => 'auth.provider.callback',
    'uses' => 'Auth\RegisterController@handleProviderCallback',
]);
Route::post('login',[
    'as' => 'auth.auth.login',
    'uses' => 'Auth\LoginController@postLogin',
]);
Route::post('register',[
    'as' => 'auth.auth.register',
    'uses' => 'Auth\RegisterController@postRegister',
]);
Route::get('logout',[
    'as' => 'auth.auth.logout',
    function(){
        Auth::logout();
        return Redirect::to('/');
    }
]);

