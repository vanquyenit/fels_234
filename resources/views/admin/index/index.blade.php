@extends('templates.admin.master')

@section('content')
<!-- top tiles -->
<div class="row tile_count">
  <div class="col-xs-3 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> {{ trans('language.admin.users.all_user') }}</span>
    <div class="count">{{ $user }}</div>
  </div>
  <div class="col-xs-3 tile_stats_count">
    <span class="count_top"><i class="fa fa-clock-o"></i> {{ trans('course.courses.all_course') }}</span>
    <div class="count">{{ $course }}</div>
  </div>
  <div class="col-xs-3 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> {{ trans('lesson.lessons.all_lessons') }}</span>
    <div class="count">{{ $lesson }}</div>
  </div>
  <div class="col-xs-3 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> {{ trans('language.admin.word') }}</span>
    <div class="count">{{ $word }}</div>
  </div>
</div>
<!-- /top tiles -->
<div class="row" id='home_page'>
  <h1 class="text-center">{{ trans('language.admin.index') }}</h1>
  <img class="img_index" src="http://www.aspiretransforms.com/wp-content/uploads/2016/01/education-banner.jpg">
</div>
@endsection
