@extends('templates.public.template')
@section('content')
@php
$arsUser = Auth::user();
$arCourse = Session::get('arCourse');
@endphp
<div id="content">
    <div class="container container-main">
        <div class="tabbed-sidebar col-xs-3">
            <div class="sidebar-box sidebar-profile">
                <div class="profile-header">
                    <div class="image-wrapper">
                        <img class="profile-image" src="{{ asset(getAvatar($arsUser['avatar'])) }}">
                    </div>
                </div>
                <div class="profile-content">
                    <div class="content-general">
                        <p class="name">{{$arsUser['username']}}</p>
                    </div>
                    <div class="content-stats">
                        <div class="left">
                            <p class="number js-num">{{ $arCourse->total == NULL ? "0" : $arCourse->total }}</p>
                            <p class="text">{{  trans('layout.learn_about') }}</p>
                        </div>
                        <div class="right">
                            <p class="number js-num">{{ $arCourse->correct == NULL ? "0" : $arCourse->correct }}</p>
                            <p class="text"> {{  trans('layout.scores') }} </p>
                        </div>
                    </div>
                    <div class="sidebar-main-btn profile-link">
                        <a href="{{ action('UserController@index', $arsUser['username']) }}" class="simple">
                            {{ trans('layout.view_profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabbed-main page col-xs-8">
            <section>
                <div class="course-cards-component js-course-cards-component">
                    @if($arLearns)
                        @foreach ($arLearns as $key => $value)
                            <div class="course-card-container js-course-card-container" id="{{ $value['course_id'] }}">
                                <div class="course-progress-box">
                                    <div class="card-top col-xs-12">
                                        <div class="card-image-col col-xs-2">
                                            <a href="{{ action('CourseController@course', [$value['course_id'], str_slug($value['course_name'])] ) }}">
                                                <div class="img-crop">
                                                    <img src="{{ asset(Storage::url($value['course_image'])) }}" class="course-photo">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-main-container col-xs-10">
                                            <div class="top-main">
                                                <div class="wrapper">
                                                    <div class="detail">
                                                        <p title="{{ $value['course_name']}}" class="title">
                                                            <a href="{{ action('CourseController@course', [$value['course_id'], str_slug($value['course_name'])] ) }}">{{ $value['course_name']}}</a>
                                                        </p>
                                                    </div>
                                                    <div class="pull-right">
                                                        <a href="javascript:void(0)">
                                                            <span class="simple-btn leaderboard-btn">
                                                            <span class="leaderboard-icon"></span>
                                                            </span>
                                                        </a>
                                                        <span class="ctrl-btn">
                                                        <span class="icon"></span>
                                                            <ul class="tooltip">
                                                                <li><a href="{{ action('CourseController@course', [$value['course_id'], str_slug($value['course_name'])] ) }}" class="option-btn">
                                                                <i class="option-pin"></i>
                                                                    {{ trans('layout.info_course') }}</a>
                                                                </li>
                                                                <li>
                                                                <span class="option-btn delete_course" data-id="{{ $value['course_id']}}">
                                                                <i class="option-delete"></i>{{ trans('layout.remove_course') }}</span>
                                                                </li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                    <div class="wrapper">
                                                        <div class="course-progress">
                                                            <div class="right"><span>{{ trans('layout.learned') .  $value['resutl']}} / {{ $value['total'] .  trans('layout.char')}} </span> </div>
                                                            <div class="progress-bar-container">
                                                                <div  class="progress-bar" data-progress="{{ ($value['resutl'] / $value['total'] ) * 100 }}"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-bottom">
                                        <div class="course-actions">
                                            <a href="{{ action('CourseController@review', [$value['course_id']]) }}" title="" data-toggle="tooltip" data-placement="bottom" class="button blue">
                                               <span class="text">{{ trans('layout.review') }} ({{ $value['resutl'] }})</span>
                                           </a>
                                           <a href="{{ action('CourseController@course', [$value['course_id'], str_slug($value['course_name'])] ) }}" title="" data-toggle="tooltip" data-placement="bottom" class="button green" >
                                                <span class="text">{{ trans('layout.startlearn') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2 class="text-center"><a href="{{ route('course.view') }}" title="">{{ trans('layout.noCourse') }}</a></h2>
                    @endif
                </div>
            </section>
            <section>
                <h1>{{ trans('layout.follow') }}</h1>
                <div class="box box-onboarding box-follow col-xs-12">
                    <div class="people-rows row" data-user-follow="{{ $arsUser->id }}">
                        @foreach ($arRelationship as $key => $value)
                            <div class="col-xs-3" data-role="hovercard"  data-direction="top">
                                <div class="user-box">
                                    <div class="user-box-inner">
                                        <div class="user-inline">
                                            <a href="{{ action('UserController@index', $value['username']) }}">
                                                <img src="{{ asset(getAvatar($value['avatar'])) }}" alt="" class="img-rounded whitebox"> </a>
                                                <a class="username" href="{{ action('UserController@index', $value['username']) }}">
                                                {{ $value['fullname'] }}
                                            </a>
                                        </div>
                                        <a class="mempal-button button green" data-fullname="{{ $value['fullname'] }}" data-user-id="{{ $value['id'] }}" data-follow="{{ trans('layout.follow') }}"  data-unfollow="{{ trans('layout.unfollow') }}" data-role="mempal-button" data-action="{{ URL::action('UserController@following') }}">
                                            <input type="hidden" name="" value="0">
                                            <span class="text">
                                                {{ trans('layout.follow') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@stop
