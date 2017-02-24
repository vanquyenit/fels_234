@extends('templates.admin.master')

@section('content')
<div>
  <div class="col-md-12 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><i class="fa fa-bars"></i> <small>{{ trans('language.admin.category_users') }}</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content table-responsive">
        <div  role="tabpanel" data-example-id="togglable-tabs" class="table-responsive">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    {!! Form::open(['route' => 'admin.user.postDelete', 'method' => 'post']) !!}
                    {!! Form::token() !!}
                    <table id="datatable1" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>{{ trans('language.admin.users.stt') }}</th>
                          <th>{{ trans('language.admin.users.fullname') }}</th>
                          <th>{{ trans('language.admin.users.username') }}</th>
                          <th>{{ trans('language.admin.users.email') }}</th>
                          <th>{{ trans('language.admin.users.avatar') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($user as $key => $itemUser)
                        <tr>
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
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {!! Form::close() !!}
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
