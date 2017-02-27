<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer">
        <div class="container">
            <div class="row">
                <aside id="text-2" class="col-xs-6 widget widget_text footer_widget">
                    <h4 class="widget-title">{{ trans('layout.about') }}</h4>
                    <div class="textwidget">
                        <p><img src="{{ asset('/images/logo-footer.png') }}" alt="logo-footer" kasperskylab_antibanner="on"> </p>
                        <p>{{ trans('layout.welcome') }}</p>
                    </div>
                </aside>
                <aside id="tweets-feed-2" class="col-xs-6 widget widget_tweets-feed footer_widget">
                    <div class="thim-widget-tweets-feed thim-widget-tweets-feed-base">
                        <h4 class="widget-title">{{ trans('layout.the_best_learn') }}</h4>
                        <ul class="tweet">
                            <li> {{ trans('layout.content') }} </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p class="text-copyright">{{ trans('layout.copyright') }} <i class="fa fa-copyright"></i> {{ trans('layout.design') }} </p>
                </div>
            </div>
        </div>
    </div>
</footer>
{{ Form::hidden('confirm', trans('layout.confirm'), ["id" => 'confirmDelete']) }}
<a href="#" id="back-to-top"> <i class="fa fa-chevron-up"></i> </a>
</div>
</div>
