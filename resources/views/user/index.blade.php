@extends('templates.public.template')

@section('content')
{{ Html::style('css/profile.css') }}
<div id="page-head" class="">
    <div class="inner">
        <div class="avatar-wrap">
            <img src="{{ asset(getAvatar($arUser['avatar'])) }}" alt=""> </div>
        <div class="col-main">
            <div class="user-details">
                <div class="user-actions">
                    <a href="#" class="button" data-toggle="modal" data-target="#register"><span class="ico ico-edit"></span> {{ trans('layout.editprofile') }}</a>
                </div>
                <h1>{{ $arUser['fullname'] }}</h1>
                <div class="content-badges">
                    <span class="profile-badge rank memonimee" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title=""></span>
                </div>
            </div>
            <hr class="clear">
            <ul class="profile-stats">
                <li>
                    <span class="ico ico-white ico-m ico-follow"></span>
                    <strong data-role="follower-count">{{ count($arFollower) }}</strong>
                    <a>{{ trans('layout.follower') }}</a>
                </li>
                <li>
                    <span class="ico ico-white ico-m ico-people"></span>
                    <strong data-role="follower-count">{{ count($arFollowing) }}</strong>
                    <a>{{ trans('layout.following') }}</a>
                </li>
                <li>
                    <span class="ico ico-white ico-m ico-flower"></span>
                    <strong>
                        @if($arLearns)
                            {{ $arLearns->total }}
                        @else
                            {{ config('setting.zero') }}
                        @endif
                    </strong>
                    {{ trans('layout.char') }}
                </li>
                <li>
                    <span class="ico ico-white ico-m ico-star"></span>
                    <strong class="tat-value-xs">
                        @if($arLearns)
                            {{ $arLearns->correct }}
                        @else
                            {{ config('setting.zero') }}
                        @endif
                    </strong>
                    <a href="">{{ trans('layout.scores') }}</a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="row profile_user">
    <div class="container col-xs-8">
        <div class="well profile_User">
           <ul id='timeline'>
               @foreach ($activity->activities as $element => $value)
                    <li class='work'>
                        {!! Form::radio('works', '', 'checked', ['class' => 'radio', 'id' => 'work5']) !!}
                        <div class="relative">
                            <label for='work5'>{{ $value->action_type }}</label>
                            <span class='date'>{{ date_format($value->created_at, 'h:i d.m.y')  }}</span>
                            <span class='circle'></span>
                        </div>
                        <div class='content'>
                          <p></p>
                        </div>
                    </li>
               @endforeach
            </ul>
        </div>
    </div>
    <div class="container col-xs-4 pull-right">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">{{ trans('layout.follower') }}</a>
            </li>
            <li>
                <a data-toggle="tab" href="#menu1">{{ trans('layout.following') }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="box box-onboarding box-follow col-xs-12">
                    <div class="people-rowsa row" data-user-follow="{{ $arUser['id'] }}">
                        @foreach ($arFollower as $key => $element)
                            <div class="col-xs-6" data-role="hovercard"  data-direction="top">
                                <div class="user-box">
                                    <div class="user-box-inner">
                                        <div class="user-inline">
                                            <a href="{{ action('UserController@index', $element['username']) }}">
                                                <img src="{{ asset(getAvatar($element['avatar'])) }}" alt="" class="img-rounded whitebox">
                                            </a>
                                            <a class="username" href="{{ action('UserController@index', $element['username']) }}">
                                                {{ $element['fullname'] }}
                                            </a>
                                        </div>
                                        <a class="mempal-button button " data-fullname="{{ $element['fullname'] }}" data-user-id="{{ $element['id'] }}" data-follow="{{ trans('layout.follow') }}"  data-unfollow="{{ trans('layout.unfollow') }}" data-role="mempal-button" data-action="{{ URL::action('UserController@following') }}">
                                            {!! Form::hidden('hidden', config('setting.admin'), []) !!}
                                            <span class="text">
                                                {{ trans('layout.unfollow') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="box box-onboarding box-follow col-xs-12">
                    <div class="people-rowsa row" data-user-follow="{{ $arUser['id'] }}">
                        @foreach ($arFollowing as $key => $element)
                            <div class="col-xs-6" data-role="hovercard"  data-direction="top">
                                <div class="user-box">
                                    <div class="user-box-inner">
                                        <div class="user-inline">
                                            <a href="{{ action('UserController@index', $element['username']) }}">
                                                <img src="{{ asset(getAvatar($element['avatar'])) }}" alt="" class="img-rounded whitebox">
                                            </a>
                                            <a class="username" href="{{ action('UserController@index', $element['username']) }}">
                                                {{ $element['fullname'] }}
                                            </a>
                                        </div>
                                        <a class="mempal-button button green" data-fullname="{{ $element['fullname'] }}" data-user-id="{{ $element['id'] }}" data-follow="{{ trans('layout.follow') }}"  data-unfollow="{{ trans('layout.unfollow') }}" data-role="mempal-button" data-action="{{ URL::action('UserController@following') }}">
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
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {!! Form::submit('x', ['class' => 'close', 'data-dismiss' => "modal", 'aria-label' => "Close"]) !!}
                <h4 class="modal-title" id="myModalLabel">{{ trans('layout.editprofile') }}</h4>
            </div>
            @if (count($errors))
                <p id='thongbao' class='hidden'>{{ trans('layout.validate_error') }}</p>
                <div class=" alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                         <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['route' => ['users.updateUser',isset($arUser) ? $arUser->id : null], 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data', 'id' => 'frmEdit']) !!}
                <div class="modal-body">
                    {!! Form::token() !!}
                    <div class="item form-group">
                        {!! Form::label('fullname', trans('language.admin.users.fullname'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('fullname', old('fullname', isset($arUser) ? $arUser->fullname : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'fullname']) !!}
                        </div>
                    </div>
                    <div class="item form-group">
                        {!! Form::label('username', trans('language.admin.users.username'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('username', old('username',isset($arUser) ? $arUser->username : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'username']) !!}
                        </div>
                    </div>
                    <div class="item form-group">
                        {!! Form::label('email', trans('language.admin.users.email'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::email('email', old('email',isset($arUser) ? $arUser->email : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
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
                        {!! Form::label('image', trans('language.admin.users.avatar'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="image" class="uploadimg">
                                <img src="{{ asset(getAvatar($arUser['avatar'])) }}" data-img="{{ asset(getAvatar($arUser['avatar'])) }}" />
                                {!! Form::file('imagesUpdate', ['id' => 'image', 'class' => 'hide edit_image_user']) !!}
                                <i class="removefile" title="Xóa">&times;</i>
                            </label>
                        </div>
                    </div>
                    {{ Html::style('Admin/css/style.css') }}
                </div>
                <div class="modal-footer">
                    {!! Form::submit(trans('language.admin.users.cancel'), ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', 'aria-hidden' => 'true']) !!}
                    {!! Form::submit(trans('language.admin.users.edit'), ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
