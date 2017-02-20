@extends('templates.master')

@section('content')
<div class="login-box animated fadeInUp">
    <div class="box-header">
        <h2>{{ trans('forgotpassword.resetpassword.new_password') }}</h2>
    </div>

    @if (Session::has('flash_messages'))
        <div class="alert alert-{!! Session::get('flash_level') !!}">
            {!! Session::get('flash_messages') !!}
        </div>
    @endif

    @include('templates.admin.erro')
    {!! Form::open(['route' => 'auth.postForgotNewPassword', 'method' => 'post']) !!}
        {!! Form::token() !!} 
        {!! Form::label("email", trans('forgotpassword.resetpassword.email')) !!}
        <br/>
        {!! Form::text("email", old("email")) !!}
        <br/>
        {!! Form::label("password", trans('forgotpassword.resetpassword.password')) !!}
        <br/>
        {!! Form::password("password") !!}
        <br/>
        {!! Form::label("password_confirm", trans('forgotpassword.resetpassword.enter_the_password')) !!}
        <br/>
        {!! Form::password("password_confirm") !!}
        <br/>
        {!! Form::label("code", trans('forgotpassword.resetpassword.code')) !!}
        <br/>
        {!! Form::text("code") !!}
        <br/>
        {!! Form::submit(trans('forgotpassword.resetpassword.complete')) !!} 
    {!! Form::close() !!}
</div>
@endsection
