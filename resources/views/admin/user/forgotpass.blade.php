@extends('templates.master')

@section('content')
<div class="login-box animated fadeInUp">
    <div class="box-header">
        <h2>{{ trans('forgotpassword.forgot.confirmation_email') }}</h2>
    </div>

    @if (Session::has('flash_messages'))
        <div class="alert alert-{!! Session::get('flash_level') !!}">
            {!! Session::get('flash_messages') !!}
        </div>
    @endif 

    @include('templates.admin.erro') 
    {!! Form::open(['route' => 'auth.postForgotPassword', 'method' => 'post']) !!} 
        {!! Form::token() !!} 
        {!! Form::label("email", trans('forgotpassword.forgot.email')) !!}
        <br/>
        {!! Form::text("email", old("email")) !!}
        <br/>
        {!! Form::submit(trans('forgotpassword.forgot.continue')) !!} 
    {!! Form::close() !!}
</div>
@endsection
