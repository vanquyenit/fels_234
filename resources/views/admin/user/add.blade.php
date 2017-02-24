@extends('templates.admin.master')

@section('content')
<div>
  <div class="col-md-12 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-bars"></i> <small>{{ trans('language.admin.users.all_admin') }}</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div  role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('language.admin.users.all_user') }}</a>
            </li>
            <li role="presentation" ><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> {{ trans('language.admin.users.add_user') }}</a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in table-responsive" id="tab_content1" aria-labelledby="home-tab">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    {!! Form::open(['route' => 'admin.user.postDelete', 'method' => 'post']) !!}
                        {!! Form::token() !!}
                        <table id="datatable1" class="table table-striped table-bordered bulk_action">
                            <thead>
                                <tr>
                                    <th>
                                        {!! Form::checkbox('checkbox', "", "", ['id' => 'delall']) !!}
                                        {!! Form::submit(trans('language.admin.users.delete'), ['class' => 'btn btn-danger ', 'id' => 'xacnhanxoa']) !!}
                                    </th>
                                    <th>{{ trans('language.admin.users.stt') }}</th>
                                    <th>{{ trans('language.admin.users.fullname') }}</th>
                                    <th>{{ trans('language.admin.users.username') }}</th>
                                    <th>{{ trans('language.admin.users.email') }}</th>
                                    <th>{{ trans('language.admin.users.avatar') }}</th>
                                    <th>{{ trans('language.admin.users.level') }}</th>
                                    <th>{{ trans('language.admin.users.edit') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $itemUser)
                                <tr>
                                    <td>{!! Form::checkbox('ck_box[]', $itemUser->id, '') !!}</td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $itemUser->fullname }}</td>
                                    <td>{{ $itemUser->username }}</td>
                                    <td>{{ $itemUser->email }}</td>
                                    <td>
                                        @if(!empty($itemUser->avatar))
                                          <img class="imageAvatar" src="{{ asset(Storage::url($itemUser->avatar)) }}">
                                        @else
                                          {{ trans('language.admin.users.no_avatar') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($itemUser->is_admin == config('setting.admin') && $itemUser->id == config('setting.admin'))
                                          {{ trans('language.admin.users.super_admin') }}
                                        @elseif ($itemUser->is_admin == config('setting.admin') && $itemUser->id != config('setting.admin'))
                                          {{ trans('language.admin.users.admin') }}
                                        @endif
                                    </td>
                                    <td><i class="fa fa-pencil fa-fw"></i> <a class="edit" data-id="{{ $itemUser->id }}" data-toggle="modal" href='#modal-id'>{{ trans('language.admin.users.edit') }}</a></td>
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
                      {!! Form::open(['route' => 'user.store', 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::token() !!}
                        <div class="item form-group">
                            {!! Form::label('fullname', trans('language.admin.users.fullname'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('fullname', old('fullname'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'fullname']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('username', trans('language.admin.users.username'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('username', old('username'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'username']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('email', trans('language.admin.users.email'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::email('email', old('email'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('password', trans('language.admin.users.password'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::password('password', ['class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('passwordConfirm', trans('language.admin.users.enter_the_password'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::password('passwordConfirm', ['class' => 'form-control col-md-7 col-xs-12']) !!}
                        </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('fImages', trans('language.admin.users.avatar'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="fImages" class="uploadimg">
                            <img src="{!! asset(Storage::url('image.png')) !!}"
                            data-img="{!! asset(Storage::url('image.png')) !!}" />
                            {!! Form::file('images', ['id' => 'fImages', 'class' => 'hide']) !!}
                            <i class="removefile" title="Xóa">&times;</i>
                            </label>
                        </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                            {!! Form::submit(trans('language.admin.users.cancel'), ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', 'aria-hidden' => 'true']) !!}
                            {!! Form::submit(trans('language.admin.users.add'), ['class' => 'btn btn-success']) !!}
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
        <h4 class="modal-title">{{ trans('language.admin.users.edit_user') }}</h4>
      </div>
      <div class="modal-body" id="modal-edit">
        @include('admin.user.edit')
      </div>
    </div>
  </div>
</div>
@endsection
