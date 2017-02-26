@extends('templates.admin.master')

@section('content')
<div class="">
  <div class="col-md-12 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-bars"></i> <small>{{ trans('course.courses.category_course') }}</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('course.courses.all_course') }}</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> {{ trans('course.courses.add_course') }} </a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in table-responsive" id="tab_content1" aria-labelledby="home-tab">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    {!! Form::open(['route' => 'admin.course.postDelete', 'method' => 'POST']) !!}
                    {!! Form::token() !!}
                    <table id="datatable1" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                            <th>
                                <span>
                                    {!! Form::checkbox('checkbox', '', '', ['id' => 'delall']) !!}
                                    {!! Form::submit(trans('course.courses.delete'), ['class' => 'btn btn-danger', 'id' => 'xacnhanxoa']) !!}
                                </span>
                            </th>
                            <th><span>{{ trans('course.courses.stt') }}</span></th>
                            <th><span>{{ trans('course.courses.course') }}</span></th>
                            <th><span>{{ trans('course.courses.image') }}</span></th>
                            <th><span>{{ trans('course.courses.category') }}</span></th>
                            <th><span>{{ trans('course.courses.edit') }}</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($course as $key => $itemCourse)
                          <tr>
                            <td>{!! Form::checkbox('ck_box[]', $itemCourse->id, '', ['id' => 'checkbox']) !!}
                              <td>{{ $key + 1 }}</td>
                              <td><span>{{ $itemCourse->name }}</span></td>
                              <td>
                                  @if($itemCourse->image != null)
                                  <img width="100px" height="80px" src="{{ asset(Storage::url($itemCourse->image)) }}">
                                  @else
                                  {{ trans('course.courses.no_avatar') }}
                                  @endif
                              </td>
                              <td><span>{{ $itemCourse->category->name }}</span></td>
                              <td><i class="fa fa-pencil fa-fw"></i> <a class="edit" data-id="{{ $itemCourse->id }}" data-toggle="modal" href='#modal-id'>{{ trans('course.courses.edit') }}</a></td>
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
                          {!! Form::open(['route' => 'course.store', 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                          {!! Form::token() !!}
                          <div class="item form-group">
                            {!! Form::label('name', trans('course.courses.course'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                          </div>
                          <div class="item form-group">
                            {!! Form::label('category', trans('course.courses.category'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select name="category" id="input" class="form-control">
                                <option value="">{{ trans('course.courses.choose_language') }}</option>
                                @foreach($categories as $itemCate)
                                <option value="{!! $itemCate->id !!}">{!! $itemCate->name !!}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                             {!! Form::label('fImages', trans('course.courses.image'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                             <div class="col-md-6 col-sm-6 col-xs-12">
                               <label for="fImages" class="uploadimg">
                                <img src="{!! asset(Storage::url('image.png')) !!}"
                                data-img="{!! asset(Storage::url('image.png')); !!}" />
                                {!! Form::file('image', ['id' => 'fImages', 'class' => 'hide']) !!}
                                <i class="removefile">&times;</i>
                              </label>
                            </div>
                          </div>
                          <link rel="stylesheet" type="text/css" href="{{ asset('Admin/css/style.css') }}">
                          <div class="item form-group">
                            {!! Form::label('describe', trans('course.courses.describe'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::textarea('describe',old('describe'), ['class' => 'col-md-12 col-xs-12', 'size' => '200x4']) !!}
                            </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                              {!! Form::submit( trans('course.courses.add'), ['class' => 'btn btn-success']) !!}
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
    <div class="modal fade" id="modal-id">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{ trans('course.courses.edit_course') }}</h4>
          </div>
          <div class="modal-body">
            @include('admin.course.edit')
          </div>
        </div>
      </div>
    </div>
    @endsection
