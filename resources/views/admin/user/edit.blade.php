{!! Form::open(['route' => ['user.update',isset($user) ? $user->id : null], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data', 'id' => 'frmEdit']) !!}
    {!! Form::token() !!}
    <div class="item form-group">
        {!! Form::label('fullname', trans('language.admin.users.fullname'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('fullname', old('fullname', isset($user) ? $user->fullname : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'fullname']) !!}
        </div>
    </div>
    <div class="item form-group">
        {!! Form::label('username', trans('language.admin.users.username'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('username', old('username',isset($user) ? $user->username : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'username']) !!}
        </div>
    </div>
    <div class="item form-group">
        {!! Form::label('email', trans('language.admin.users.email'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::email('email', old('email',isset($user) ? $user->email : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
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
                <img src="{!! asset(Storage::url(old('image', isset($user) ? $user->avatar : null))) !!}"
                data-img="{!! asset(Storage::url(old('image', isset($user) ? $user->avatar : null))) !!}" />
                {!! Form::file('imagesUpdate', ['id' => 'image', 'class' => 'hide edit_image_user']) !!}
                <i class="removefile" title="Xóa">&times;</i>
            </label>
        </div>
    </div>
    {{ Html::style('Admin/css/style.css') }}
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::submit(trans('language.admin.users.cancel'), ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', 'aria-hidden' => 'true']) !!}
            {!! Form::submit(trans('language.admin.users.edit'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>
{!! Form::close() !!}
