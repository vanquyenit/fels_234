@extends('templates.public.template')

@section('content')
<div id="content" class="">
    <div class="container container-main">
        @if ($name->level > 1)
        <a href="{{ route('course.lesson', [$id, $slug, $name->level - 1, trans('layout.url.back')]) }}" class="level-nav level-nav-prev" title="" >
            <i class="ico ico-left ico-arr-left"></i>
            <span class="level-name">{{ trans('layout.level') . ($name->level - 1) }}</span>
        </a>
        @endif
        <a href="{{ route('course.lesson', [$id, $slug, $name->level + 1, trans('layout.url.learn')]) }}" class="level-nav level-nav-next"  title="" >
            <span class="level-name">{{ trans('layout.level') . ($name->level + 1) }}</span>
            <i class="ico ico-left ico-arr-right"></i>
        </a>
        <div class="central-column col-xs-9">
            <div class="progress-box progress-box-level with-icon">
                <div class="level-icon">
                    <strong class="level-number">
                        {{ trans('layout.level') . $name->level }}
                    </strong>
                    <i class="level-ico level-ico-plant"></i>
                </div>
                <div class="infos">
                    <h3 class="progress-box-title"> {{ $name->name }} </h3>
                    {{ $learned . ' /' . count($lesson) }}
                    <div class="progress" title="" data-placement="bottom" data-original-title="learned">
                        <span class="bar bar-success" data-progress="{{ ($learned/count($lesson)) * 100 }}"></span>
                    </div>
                </div>
                <hr>
                <div class="actions actions-right col-xs-6 pull-right">
                    <a href="{{ route('learn.action', [$id, $slug, $name->level, str_slug($name->name), trans('layout.url.start')]) }}" class="button blue" title="">
                        {{ trans('layout.startlearn') }}
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <h4> {{ count($lesson) . trans('layout.char')}} </h4>
            <div class="things clearfix" data-column-a="1" data-column-b="2">
                @foreach ($lesson as $element)
                <div class="thing text-text">
                    <div class="col_a col text">
                        <div class="text">{{ $element->word->content }}</div>
                    </div>
                    <div class="col_b col text">
                        <div class="text">{{ $element->wordAnswer->content }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
