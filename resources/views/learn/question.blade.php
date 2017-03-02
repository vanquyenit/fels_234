<div id="gardening-area" class="clearfix gardening-area js-gardening-area">
    @if ($rand == 1)
        <div id="central-area" class="central-area js-central-area" >
            <div id="boxes">
                <div class="garden-box presentation show-more show-want-mem">
                    <button class="next-button btn btn-inverse clearfix" title="{{ trans('layout.next') }}" >
                        <span class="next-icon"></span>
                        <div class="next-text">{{ trans('layout.next') }}</div>
                    </button>
                    <div class="thing-show has-first-audio show-more">
                        <div class="columns have-attributes">
                            <div class="row column primary" data-column-index="1">
                                <div class="row-label">{{ trans('layout.english') }}</div>
                                <div class="row-value">
                                    <div class="primary-value" id='readWords'>
                                        {{ $question['word']['content'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="row column  secondary" data-column-index="2">
                                <div class="row-label">{{ trans('layout.vietnamese') }}</div>
                                <div class="row-value">
                                    <div class="primary-value">
                                        {{ $question['word_answer']['content'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="row column  first-audio" data-column-index="3">
                                <div class="row-label">{{ trans('layout.audio') }}</div>
                                <div class="row-value">
                                    <div class="primary-value">
                                        <a class="audio-player audio-player-hover" id='WordsRead' href="javascript:void(0)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($rand == 2)
        <div id="gardening-area" class="clearfix gardening-area js-gardening-area">
            <div id="central-area" class="central-area js-central-area wide" >
                <div id="boxes">
                    <div class="garden-box video-pre-presentation show-more">
                        <button class="next-button btn btn-inverse clearfix" title="{{ trans('layout.next') }}" >
                            <span class="next-icon"></span>
                            <div class="next-text">{{ trans('layout.next') }}</div>
                        </button>
                        <div class="question-row audio-typing clearfix">
                            <div class="qquestion audio-typing">
                                {{ $question['word_answer']['content'] }}
                            </div>
                        </div>
                        <ol class="choices unchosen clearfix" data-question="{{ $question['id'] }}">
                            @php $i = 1; @endphp
                            @foreach($answer as $element)
                            <li class="shiny-box choice clearfix" data-choice-id="{{ $element['id'] }}" >
                                <span class="index">{{ $i }}</span>
                                <span class="val ">{{ $element['word']['content'] }}</span>
                                <span class="marking-icon"></span>
                            </li>
                            @php $i++; @endphp
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($rand == 3)
        <div id="gardening-area" class="clearfix gardening-area js-gardening-area">
            <div id="central-area" class="central-area js-central-area" >
                <div id="boxes">
                    <div class="garden-box multiple_choice">
                        <button class="next-button btn btn-inverse clearfix" title="{{ trans('layout.next') }}" >
                            <span class="next-icon"></span>
                            <div class="next-text">{{ trans('layout.next') }}</div>
                        </button>
                        <div class="question-row clearfix" data-thing-id="67340749">
                            <div class="graphic colour-1"></div>
                            <div class="qquestion qtext  ">{{ $question['word']['content'] }}</div>
                            <div class="extra-info  "></div>
                        </div>
                        <div class="hint">
                            <span class="hint-text">{{ trans('layout.select') }}</span>
                        </div>
                        <ol class="choices unchosen clearfix grid"  data-question="{{ $question['id'] }}">
                            @php $i = 1; @endphp
                            @foreach($answer as $element)
                            <li class="shiny-box choice clearfix" data-choice-id="{{ $element['id'] }}" >
                                <span class="index">{{ $i }}</span>
                                <span class="val ">{{ $element['word_answer']['content'] }}</span>
                                <span class="marking-icon"></span>
                            </li>
                            @php $i++; @endphp
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($rand == 4)
        <div id="gardening-area" class="clearfix gardening-area js-gardening-area">
            <div id="central-area" class="central-area js-central-area" >
                <div id="boxes">
                    <div class="garden-box multiple_choice">
                        <button class="next-button btn btn-inverse clearfix" title="{{ trans('layout.next') }}" >
                            <span class="next-icon"></span>
                            <div class="next-text">{{ trans('layout.next') }}</div>
                        </button>
                        <div class="question-row clearfix">
                            <div class="qquestion audio-typing">
                                <div class="audio-prompt js-audio-prompt" id='WordsRead'>
                                    <div class="hidden" id='readWords'>
                                        {{ $question['word']['content'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="extra-info  "></div>
                        </div>
                        <div class="hint">
                            <span class="hint-text">{{ trans('layout.select') }}</span>
                        </div>
                        <ol class="choices unchosen clearfix grid" data-question="{{ $question['id'] }}">
                            @php $i = 1; @endphp
                            @foreach($answer as $element)
                            <li class="shiny-box choice clearfix" data-choice-id="{{ $element['id'] }}" >
                                <span class="index">{{ $i }}</span>
                                <span class="val ">{{ $element['word']['content'] }}</span>
                                <span class="marking-icon"></span>
                            </li>
                            @php $i++; @endphp
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($rand == 0)
        <div id="gardening-area" class="clearfix gardening-area js-gardening-area">
            <div id="central-area" class="central-area js-central-area" >
                <div id="boxes">
                    <div class="garden-box multiple_choice">
                        <button class="next-button btn btn-inverse clearfix" title="{{ trans('layout.next') }}" >
                            <span class="next-icon"></span>
                            <div class="next-text">{{ trans('layout.next') }}</div>
                        </button>
                        <div class="question-row audio-typing clearfix" data-thing-id="67340745">
                            <div class="qquestion audio-typing">
                                <div class="audio-prompt js-audio-prompt" id='WordsRead'>
                                    <div class="hidden" id='readWords'>
                                        {{ $question['word']['content'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hint">
                            <span class="hint-text">{{ trans('layout.select') }}</span>
                        </div>
                        <ol class="choices unchosen clearfix " data-question="{{ $question['id'] }}">
                            @php $i = 1; @endphp
                            @foreach($answer as $element)
                            <li class="shiny-box choice clearfix" data-choice-id="{{ $element['id'] }}">
                                <span class="index">{{ $i }}</span>
                                <span class="val ">{{ $element['word_answer']['content'] }}</span>
                                <span class="marking-icon"></span>
                            </li>
                            @php $i++; @endphp
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
