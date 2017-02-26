{!! Form::open(['route' => ['category.update', isset($category) ? $category->id : null], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'id' => 'frmEdit']) !!}
{!! Form::token() !!}
<div class="item form-group">
  {!! Form::label('name', trans('category.cate.name_category'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name', isset($category) ? $category->name : null), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
  </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit(trans('category.cate.cancel'), ['class' => 'btn btn-danger', 'aria-hidden' => 'true', 'data-dismiss' => 'modal']) !!}
    {!! Form::submit(trans('category.cate.edit'), ['class' => 'btn btn-success']) !!}
  </div>
</div>
{!! Form::close() !!}
