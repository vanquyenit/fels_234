@extends('templates.public.template')
@section('content')
<div id="page-head" class="">
    <div class="inner">
        <div class="course-header course-header-fat clearfix">
            <div class="more-info">
                <div class="share-box">
                    <div class="buttons-wrap" data-share-type="course">
                        <div class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button_count" data-size="large" data-mobile-iframe="true">
                            <a class="fb-xfbml-parse-ignore" target="_blank" href="{{ Request::fullUrl() }}">{{ trans('layout.share_fb') }}</a>
                        </div>
                        <a href="https://twitter.com/share" class="twitter-share-button" data-size="large" data-dnt="true" data-show-count="false">{{ trans('layout.share_tt') }}</a>
                        {{ Html::script('//platform.twitter.com/widgets.js') }}
                    </div>
                </div>
            </div>
            <a href="" class="course-photo">
                <img src="{{ asset(Storage::url($arCourse['image'])) }}">
            </a>
            <div class="course-details">
                <a href="" accesskey="c">
                    <h1 class="course-name">{{ $arCourse['name'] }}</h1>
                </a>
                <span class="course-description">
                    <span class="text">{{ $arCourse['describe'] }}</span>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="course-tabs-wrap">
    <div class="container">
        <div class="left">
            <ul class="nav nav-pills chromeless">
                <li class="active">
                    <a href="" class="tab"> <i class="ico ico-list"></i>
                        {{ trans('layout.level') . count($arCourse->lessons) }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="right"></div>
    </div>
</div>
<div id="content" class="">
    <div class="container container-main">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="progress-box progress-box-course col-xs-12">
                    <div class="infos">
                        <div class="progress-box-title"> {{ trans('layout.learned') . $arLearns['resutl'] }} / {{ $arLearns['total'] . trans('layout.char') }}</div>
                        <div class="progress" title="" data-placement="bottom">
                            <div class="bar-success bar-abs bar" data-progress="{{ ($arLearns['resutl']/$arLearns['total'])*100 }}"></div>
                        </div>
                    </div>
                    <div class="actions actions-right col-xs-6 pull-right">
                        <a href="{{ action('CourseController@lesson', [$arCourse->id, str_slug($arCourse['name']), $reviewLesson, trans('layout.url.learn')]) }}" class="button green"  title="" data-placement="top">
                            {{ trans('layout.startlearn') }}
                        </a>
                    </div>
                </div>
                <div class="levels clearfix row">
                    @foreach ($arCourse->lessons as $element)
                    @if($element['all'] == 0) @php $all = 1 @endphp
                    @else @php $all = $element['all']; @endphp
                    @endif
                    <div class="col-xs-4 col-sm-4 col-lg-2">
                        <a href="{{ action('CourseController@lesson', [$arCourse->id, str_slug($arCourse['name']), $element['level'], str_slug($element['name'])] ) }}" class="level clearfix ">
                            <div class="level-index">{{ $element['level'] }}</div>
                            <div class="level-icon">
                                <i class="level-ico level-ico-s level-ico-plant"></i>
                                @if (( $element['learned']/$all ) == 1)
                                    <div class="level-status">
                                        <span class="ico ico-complete ico-correct ico-m ico-green"></span>
                                    </div>
                                @else
                                    <div class="level-status">
                                        <div class="progress">
                                            <div class="bar bar-success" data-progress="{{ ($element['learned']/$all) * 100 }}"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="level-title"> {{ $element['name'] }} </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
