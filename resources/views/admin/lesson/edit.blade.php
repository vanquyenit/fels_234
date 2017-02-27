@extends('templates.admin.master')

@section('content')
<div>
    <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> <small>{{ trans('lesson.lessons.edit_lesson') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    {!! Form::open(['route' => ['lesson.update', $id], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'id' => 'frmEdit', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::token() !!}
                        <div class="item form-group">
                            {!! Form::label('name', trans('lesson.lessons.lesson'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('name', old('name', isset($joinLessons) ? $joinLessons->name : null), ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('fImages', trans('lesson.lessons.image'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label for="fImages" class="uploadimg">
                                    <img src="{!! asset(Storage::url(isset($joinLessons) ? $joinLessons->image : null)) !!}" data-img="{!! asset(Storage::url(isset($joinLessons) ? $joinLessons->image : null)) !!}" />
                                    {!! Form::file('imageUpdate', ['id' => 'fImages', 'class' => 'hide']) !!}
                                    <i class="removefile">&times;</i>
                                </label>
                            </div>
                        </div>
                        {{ Html::style('Admin/css/style.css') }}
                        <div class="item form-group">
                            {!! Form::label('course', trans('lesson.lessons.category_course'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="course" id="input" class="form-control">
                                    <option value="">{{ trans('lesson.lessons.select_coures') }}</option>
                                    @foreach ($course as $itemCourse)
                                        @if($joinLessons->course_id == $itemCourse->id)
                                            @php  $selected = "selected='selected'" @endphp
                                        @else
                                            @php $selected = "" @endphp
                                        @endif
                                        <option {{ $selected }} value="{!! $itemCourse->id !!}">{!! $itemCourse->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('level', trans('lesson.lessons.category_lesson'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="level" id="input1" class="form-control">
                                    <option value="">{{ trans('lesson.lessons.select_lesson') }}</option>
                                    @for ($i = 1; $i <= 100; $i ++)
                                        @if($joinLessons->level == $i)
                                            @php  $selected = "selected='selected'"; @endphp
                                        @else
                                            @php $selected = ""; @endphp
                                        @endif
                                        <option {{ $selected }} value="{!! $i !!}">{!! trans('lesson.lessons.lesson') . " " . $i !!}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            {!! Form::label('category', trans('lesson.lessons.category_word'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <select name="category" id="input2" class="form-control">
                                    <option value="">{{ trans('lesson.lessons.select_word') }}</option>
                                    @for ($i = 4; $i <= 20; $i ++)
                                        <option value="{!! $i !!}">{!! trans('lesson.lessons.add_word') . " " . $i !!}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        @foreach ($joinLessons->lessonWords as $element)
                            <div class="item form-group" id="{{ $element->id }}">
                                {!! Form::label("add_word", trans("lesson.lessons.add_word"), ["class" => "control-label col-sm-2 col-xs-12"]) !!}
                                <div class="col-sm-3 col-xs-12">
                                    {!! Form::text("wordUpdate[".$element->word_id."]", old("word", $element->word->content), ["class" => "form-control col-md-7 col-xs-12"]) !!}
                                </div>
                                {!! Form::label("meaningWords", trans("lesson.lessons.meaning_words"), ["class" => "control-label col-sm-1 col-xs-12"]) !!}
                                <div class="col-sm-5 col-xs-12">
                                    {!! Form::text("meaningWordUpdate[".$element->word_answer_id."]", old("meaning_words", $element->wordAnswer->content), ["class" => "form-control col-md-7 col-xs-12"]) !!}
                                </div>
                                <a href="javascript:void(0)" class="deleteWord" data-id="{{ $element->id }}"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        @endforeach
                        <div class="append_word"></div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                {!! Form::submit(trans('lesson.lessons.edit'), ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
