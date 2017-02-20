@extends('templates.master')

@section('content')
<div class="login-box animated fadeInUp">
    <div class="box-header">
        <h2>{{ trans('login.login.login') }}</h2>
    </div>

    @if (Session::has('flash_messages'))
        <div class="alert alert-{!! Session::get('flash_level') !!}">
            {!! Session::get('flash_messages') !!}
        </div>
    @endif

    @include('templates.admin.erro')
    {!! Form::open(['route' => 'auth.postLoginAdmin', 'method' => 'post']) !!}
        {!! Form::label("username", trans('login.login.acount')) !!}
        <br/>
        {!! Form::text("username", old("username")) !!}
        <br/>
        {!! Form::label("password", trans('login.login.password')) !!}
        <br/>
        {!! Form::password("password") !!}
        <br/>
        {!! Form::submit(trans('login.login.login')) !!} 
    {!! Form::close() !!}
    <a href="{{ route('auth.getForgotPassword') }}">
        <p class="small">{{ trans('login.login.Forgot_your_password') }}</p>
    </a>
</div>
@endsection
