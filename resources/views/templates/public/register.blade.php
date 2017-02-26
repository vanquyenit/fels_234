<div class="modal fade" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center"> {{ trans('layout.login') }}</h4>
            </div>
            <div class="modal-body">
                <div class="spaced">
                    {!! Form::open(['route' => 'auth.auth.login', 'method' => 'post', 'class' => 'form-full-width']) !!}
                    <a href="{{ route('auth.provider.login', trans('layout.url.google')) }}" class="btn btn-gplus btn-connect btn-large">
                        <span class="ico-wrap">
                            <span class="ico ico-gplus ico-white ico-m"></span>
                        </span> {{ trans('layout.google') }}
                    </a>
                    <div class="spacer"></div>
                    <a href="{{ route('auth.provider.login', trans('layout.url.facebook')) }}" class="btn btn-flacebook btn-connect btn-large">
                        <span class="ico-wrap">
                            <span class="ico ico-facebook ico-white ico-m"></span>
                        </span> {{ trans('layout.facebook') }}
                    </a>
                    <div class="spacer"></div>
                    <a href="{{ route('auth.provider.login', trans('layout.url.twitter')) }}" class="btn btn-twitter btn-connect btn-large">
                        <span class="ico-wrap">
                            <span class="ico ico-twitter ico-white ico-m"></span>
                        </span>{{ trans('layout.twitter') }}
                    </a>
                    <div class="interruption row-fluid">
                        <div class="span5">
                            <hr class="dashed">
                        </div>
                        <div class="span2">{{ trans('layout.or') }}</div>
                        <div class="span5">
                            <hr class="dashed">
                        </div>
                    </div>
                    <div class="field ">
                        {!! Form::label("email", trans('layout.regis.mail')) !!}
                        {!! Form::email("email", old("email")) !!} </div>
                        <div class="field ">
                            {!! Form::label("password", trans('layout.regis.password')) !!}
                            {!! Form::password("password") !!}
                        </div>
                        {!! Form::submit(trans('layout.login'), ['class' => 'btn-success btn-large']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="register">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center"> {{ trans('layout.regsiter') }}</h4>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                    <p id='thongbao' class='hidden'>{{ trans('layout.validate_error') }}</p>
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="spaced">
                        {!! Form::open(['route' => 'auth.auth.register', 'method' => 'post', 'class' => 'form-full-width']) !!}
                        <div class="field ">
                            {!! Form::label("username", trans('layout.regis.username')) !!}
                            {!! Form::text("username", old("username")) !!}
                        </div>
                        <div class="field ">
                            {!! Form::label("fullname", trans('layout.regis.fullname')) !!}
                            {!! Form::text("fullname", old("fullname")) !!}
                        </div>
                        <div class="field ">
                            {!! Form::label("email", trans('layout.regis.mail')) !!}
                            {!! Form::email("email", old("email")) !!}
                        </div>
                        <div class="field ">
                            {!! Form::label("password", trans('layout.regis.password')) !!}
                            {!! Form::password("password") !!}
                        </div>
                        <div class="field ">
                            {!! Form::label("password_confirm", trans('layout.regis.re_password')) !!}
                            {!! Form::password("password_confirm") !!}
                        </div>
                        {!! Form::submit(trans('layout.regsiter'), ['class' => 'btn-success btn-large']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
