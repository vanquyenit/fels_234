<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>@if(Auth::user()) {{ Auth::user()->username }} @endif</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('index.index') }}"><i class="fa fa-home"></i> {{ trans('language.admin.home') }}</a>
            </li>
            <li><a href="{{ route('category.index') }}"><i class="glyphicon glyphicon-th-list"></i> {{ trans('language.admin.category') }} </a></li>
            <li><a href="{{ route('course.index') }}"><i class="glyphicon glyphicon-list"></i> {{ trans('language.admin.course') }} </a></li>
            <li><a href="{{ route('lesson.index') }}"><i class="glyphicon glyphicon-book"></i> {{ trans('language.admin.lesson') }} </a></li>
            <li><a href="{{ route('user.index') }}"><i class="glyphicon glyphicon-user"></i> {{ trans('language.admin.admin') }}</a></li>
        </ul>
    </div>
    <div class="menu_section">
        <ul class="nav side-menu">
            <li>
                <a><i class="glyphicon glyphicon-equalizer"></i> {{ trans('language.admin.statistics') }} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('admin.user.getMember') }}">{{ trans('language.admin.category_users') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
