@extends('templates.admin.master')

@section('content')
<div>
    <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i><small>{{ trans('lesson.lessons.lessons_list') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('lesson.lessons.all_lessons') }}</a></li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> {{ trans('lesson.lessons.add_lessons') }} </a>  </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in table-responsive" id="tab_content1" aria-labelledby="home-tab">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        {!! Form::open(['route' => 'admin.lesson.postDelete', 'method' => 'POST']) !!}
                                            {!! Form::token() !!}
                                            <table id="datatable1" class="table table-striped table-bordered bulk_action">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <span>
                                                                {!! Form::checkbox('checkbox', '', '', ['id' => 'delall']) !!}
                                                                {!! Form::submit(trans('lesson.lessons.delete'), ['class' => 'btn btn-danger', 'id' => 'xacnhanxoa']) !!}
                                                            </span>
                                                        </th>
                                                        <th><span>{{ trans('lesson.lessons.stt') }}</span></th>
                                                        <th><span>{{ trans('lesson.lessons.lesson') }}</span></th>
                                                        <th><span>{{ trans('lesson.lessons.image') }}</span></th>
                                                        <th><span>{{ trans('lesson.lessons.course') }}</span></th>
                                                        <th><span>{{ trans('lesson.lessons.edit') }}</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lessons as $key => $itemLesson)
                                                        <tr>
                                                            <td>{!! Form::checkbox('ck_box[]', $itemLesson->id, '', ['id' => 'checkbox']) !!}
                                                            <td>{{ $key + 1 }}</td>
                                                            <td><span>{{ $itemLesson->name }}</span></td>
                                                            <td>
                                                                @if ($itemLesson->image)
                                                                    <img class="imageAvatar" src="{{ asset(Storage::url( $itemLesson->image)) }}">
                                                                @else
                                                                    {{ trans('lesson.lessons.no_avatar') }}
                                                                @endif
                                                            </td>
                                                            <td><span>{{ $itemLesson->course->name }}</span></td>
                                                            <td><i class="fa fa-pencil fa-fw"></i> <a class=""  href='{{ route ('lesson.edit',$itemLesson->id) }}'>{{ trans('lesson.lessons.edit') }}</a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade " id="tab_content2" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            {!! Form::open(['route' => 'lesson.store', 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                                                <div class="item form-group">
                                                    {!! Form::label('name', trans('lesson.lessons.lesson'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12']) !!}
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    {!! Form::label('fImages', trans('lesson.lessons.image'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <label for="fImages" class="uploadimg">
                                                            <img src="{!! asset('Admin/images/image.png') !!}" data-img="{!! asset('Admin/images/image.png') !!}" />
                                                            {!! Form::file('image', ['id' => 'fImages', 'class' => 'hide']) !!}
                                                            <i class="removefile">&times;</i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    {!! Form::label('course', trans('lesson.lessons.category_course'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select name="course" id="input" class="form-control">
                                                            <option value="">{{ trans('lesson.lessons.select_coures') }}</option>
                                                            @foreach ($courses as $itemCourse)
                                                                <option value="{!! $itemCourse->id !!}">{!! $itemCourse->name !!}</option>
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
                                                                <option value="{!! $i !!}">{!! trans('lesson.lessons.lesson') . " " . $i !!}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                <div class="item form-group">
                                                    {!! Form::label('number_word', trans('lesson.lessons.category_word'), ['class' => 'control-label col-sm-2  col-xs-12']) !!}
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <select name="number_word" id="input2" class="form-control">
                                                            <option value="">{{ trans('lesson.lessons.select_word') }}</option>
                                                            @for ($i = 4; $i <= 20; $i ++)
                                                                <option value="{!! $i !!}">{!! trans('lesson.lessons.add_word') . " " . $i !!}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="append_word"></div>
                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        {!! Form::submit( trans('lesson.lessons.add'), ['class' => 'btn btn-success']) !!}
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
