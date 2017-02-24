<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ trans('language.admin.title') }}</title>
    {{ Html::style('Admin/login/css/style.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ Html::script('bower_components/jquery/dist/jquery.min.js') }}
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
