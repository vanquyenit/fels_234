@if (Session::has("result"))
    <p id='error' class="hidden">{{ Session::get("result")}}</p>
@else
    <p id='error' class="hidden"></p>
@endif
@php
    $arsUser = Auth::user();
    $arCourse = Session::get('arCourse');
@endphp
<div id="fb-root"></div>
<div id="header" class="header-v2">
    <div class="header-row container">
        <a class="header-logo" href="{{ route('index') }}" title="{{ trans('layout.home') }}">
            <span class="header-logo-wrapper">
              <img src="{{ asset('/images/logo.png') }}" alt="">
          </span>
        </a>
        @if(isset($arsUser))
            <ul class="header-nav">
                <li class="header-nav-item plain is-active">
                    <a href="{{ route('index') }}" class="nav-item-btn">
                        <span class="nav-item-btn-text">{{ trans('layout.home') }}</span>
                    </a>
                </li>
                <li class="header-nav-item plain ">
                    <a href="{{ route('course.view') }}" class="nav-item-btn">
                        <span class="nav-item-btn-text">{{ trans('layout.course') }}</span>
                    </a>
                </li>
                <li class="header-profile-wrapper">
                    <span class="header-info-card js-info-toggle">
                        <span class="info-card-inner" accesskey="h">
                            <span class="info-card-picture">
                                <img class="profile-avatar" src="{{ asset(getAvatar($arsUser['avatar'])) }}" alt="{{ $arsUser['fullname'] }}">
                            </span>
                            <span class="profile-badge rank-badge rank-badge-memonimee rank-badge-s">
                                <span class="badge-inner badge-inner-s">
                                    <span class="badge-ico"></span>
                                </span>
                            </span>
                        </span>
                    </span>
                    <span class="header-dropdown-arrow js-info-toggle"></span>
                    <ul class="header-profile-inner ">
                        <li class="profile-row">
                            <div class="profile-col rank-badge rank-badge-memonimee rank-badge-m">
                                <div class="badge-inner badge-inner-m">
                                    <div class="badge-ico"></div>
                                </div>
                            </div>
                            <div class="profile-col rank-text rank-badge-memonimee">
                                <p class="profile-rank-text text-small">
                                    @if($arCourse->correct == NULL) {{ 0 }} @else {{ $arCourse->correct }} @endif {{ trans('layout.scores') }}</p>
                                </p>
                            </div>
                        </li>
                        <hr>
                        <li class="profile-row profile-links">
                            <a href="{{ route('users.index', $arsUser['username']) }}" class="profile-link">
                                <i class="profile-link-icon link-icon-1"></i>
                                <span class="profile-link-text">{{ trans('layout.profile') }}</span>
                            </a>
                            <a href="{{ route('auth.auth.logout') }}" class="profile-link js-logout">
                                <i class="profile-link-icon link-icon-3"></i>
                                <span class="profile-link-text">{{ trans('layout.logout') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        @else
            <ul class='btn_login pull-right list-unstyled col-xs-3'>
                <li class="col-xs-6">
                    <button type="button" class="btn btn-default" id='btn_login' data-toggle="modal" href='#login'>
                        <a  data-toggle="modal" href='#login' class="nav-item-btn">
                            <span class="nav-item-btn-text">{{ trans('layout.login') }}</span>
                        </a>
                    </button>
                </li>
                <li class="col-xs-6">
                    <button type="button" class="btn btn-default" id='btn_reigter' data-toggle="modal" href='#register'>
                        <a  data-toggle="modal" href='#register' class="nav-item-btn">
                         <span class="nav-item-btn-text">{{ trans('layout.regsiter') }}</span> </a>
                     </button>
                </li>
            </ul>
         @endif
     </div>
 </div>
 <div id="wrapper-container" class="wrapper-container">
    <div class="content-pusher">
