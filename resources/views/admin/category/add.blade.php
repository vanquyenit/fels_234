@extends('templates.admin.master')

@section('content')
<div class="">
    <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i><small>{{ trans('category.cate.category') }}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('category.cate.all_category') }}</a></li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> {{ trans('category.cate.add_category') }} </a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in table-responsive" id="tab_content1" aria-labelledby="home-tab">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            {!! Form::open(['route' => 'admin.category.postDelete', 'method' => 'POST']) !!}
                                                {!! Form::token() !!}
                                                <table id="datatable1" class="table table-striped table-bordered bulk_action">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                {!! Form::checkbox('checkbox', '', '', ['id' => 'delall']) !!}
                                                                {!! Form::submit(trans('category.cate.delete'), ['class' => 'btn btn-danger', 'id' => 'xacnhanxoa']) !!}
                                                            </th>
                                                            <th>{{ trans('category.cate.stt') }}</th>
                                                            <th>{{ trans('category.cate.name_category') }}</th>
                                                            <th>{{ trans('category.cate.edit') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categories as $key => $itemCat)
                                                            <tr>
                                                                <td> {!! Form::checkbox('ck_box[]', $itemCat->id) !!} </td>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $itemCat->name }}</td>
                                                                <td><i class="fa fa-pencil fa-fw"></i> <a class="edit" data-id="{{ $itemCat->id }}" data-toggle="modal" href='#modal-id'>{{ trans('category.cate.edit') }}</a></td>
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
                                                {!! Form::open(['route' => 'category.store', 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) !!}
                                                    {!! Form::token() !!}
                                                    <div class="item form-group">
                                                        {!! Form::label('name', trans('category.cate.name_category'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            {!! Form::submit(trans('category.cate.add'), ['class' => 'btn btn-success']) !!}
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
                    <h4 class="modal-title">{{ trans('category.cate.edit_category') }}</h4>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection
