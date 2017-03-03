<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('/images/favicon.ico') }}">
    <title>{!! trans('layout.title')!!}</title>
    {{ Html::style('css/style.css') }}
    {{ Html::style('css/custom_style.css') }}
    {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.min.css') }}
    <meta name="_token" content="{{ csrf_token() }}">
</head>

<body class="dashboard ">

    @include('templates.public.header')

    @yield('content')

    {{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
    {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::script('js/responsivevoice.js') }}
    {{ Html::script('js/custom.js') }}
    {{ Html::script('Admin/js/script.js') }}

    @include('templates.public.footer')
</body>
</html>
