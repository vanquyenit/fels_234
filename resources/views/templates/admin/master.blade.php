<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ trans('language.admin.title') }}</title>

  {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
  {{ Html::style('bower_components/font-awesome/css/font-awesome.min.css') }}
  {{ Html::style('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}
  {{ Html::style('Admin/css/custom.css') }}
  {{ Html::style('Admin/css/style.css') }}
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('index.index') }}" class="site_title"><i class="fa fa-paw"></i> <span>{{ trans('language.admin.elearning') }}</span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="{{ asset(Storage::url(Auth::user()->avatar)) }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>{{ trans('language.admin.welcome') }}</span>
              <h2>@if(Auth::user()) {{ Auth::user()->fullname }} @endif</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          @include('templates.admin.lefbar')
          <!-- /sidebar menu -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle pull-left">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()) {{ Auth::user()->fullname }} @endif
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('auth.getLogoutAdmin') }}"><i class="fa fa-sign-out pull-right"></i> {{ trans('language.admin.logout') }}</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="col-lg-12">
            @if (Session::has('flash_messages'))
            <div class="alert alert-{!! Session::get('flash_level') !!}">
              {!! Session::get('flash_messages') !!}
            </div>
            @endif
          </div>
          @include('templates.admin.erro')
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            {{ trans('language.admin.design') }}
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    {{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
    {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::script('bower_components/datatables.net/js/jquery.dataTables.min.js') }}
    {{ Html::script('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}
    {{ Html::script('Admin/js/custom.js') }}
    {{ Html::script('Admin/js/script.js') }}
</body>
</html>
