{!! Form::open(['route' => ['course.update', isset($courseEdit) ? $courseEdit->id : null], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'id' => 'frmEdit', 'enctype' => 'multipart/form-data']) !!}
{!! Form::token() !!}
<div class="item form-group">
  {!! Form::label('name', trans('course.courses.course'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name', isset($courseEdit) ? $courseEdit->name : null), ['class' => 'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
<div class="item form-group">
  {!! Form::label('category', trans('course.courses.category'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    <select name="category" id="input" class="form-control col-md-7 col-xs-12l">
      <option value="">{{ trans('course.courses.choose_language') }}</option>
      @foreach($categories as $itemCate)
        @if (isset($courseEdit))
          @if ($courseEdit->category_id == $itemCate->id)
            @php $selected = "selected='selected'"; @endphp
          @else
            @php $selected =""; @endphp
          @endif
          <option {!! $selected !!} value="{!! $itemCate->id !!}">{!! $itemCate->name !!}</option>
        @endif
      @endforeach
    </select>
  </div>
</div>
<div class="item form-group">
	{!! Form::label('image', trans('course.courses.image'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
	<div class="col-md-6 col-sm-6 col-xs-12">
		<label for="image" class="uploadimg">
			<img src="{!! asset(Storage::url(old('image', isset($courseEdit) ? $courseEdit->image : null))) !!}"
			data-img="{!! asset(Storage::url(old('image', isset($courseEdit) ? $courseEdit->image : null))) !!}" />
			{!! Form::file('imageEdit', ['id' => 'image', 'class' => 'hide edit_image_user']) !!}
			<i class="removefile">&times;</i>
		</label>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="{{ asset('Admin/css/style.css') }}">
<div class="item form-group">
  {!! Form::label('describe', trans('course.courses.describe'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::textarea('describe', old('describe', isset($courseEdit) ? $courseEdit->describe : null), ['class' => 'col-md-12 col-xs-12', 'size' => '200x4']) !!}
  </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit( trans('course.courses.cancel'), ['class' => 'btn btn-danger', 'aria-hidden' => 'true', 'data-dismiss' => 'modal']) !!}
    {!! Form::submit( trans('course.courses.edit'), ['class' => 'btn btn-success']) !!}
  </div>
</div>
{!! Form::close() !!}
