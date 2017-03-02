@extends('templates.public.template')

@section('content')

<div id="content" class="">
    <div class="container container-main">
        <div class="central-column col-xs-9">
            <div class="progress-box progress-box-level ">
                <div class="text-center">
                    <h2>{{ trans('layout.wordsLearned') }}</h2>
                </div>
                <div class="clear"></div>
            </div>
            <div class="things clearfix">
                @foreach ($arReview as $element)
                <div class="thing text-text">
                    <div class="col_a col text">
                        <div class="text">{{ $element['word']}}</div>
                    </div>
                    <div class="col_b col text">
                        <div class="text">{{ $element['word_answer'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $getReview->links() }}
        </div>
    </div>
@stop
