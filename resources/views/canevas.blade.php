<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @yield('header_css')
    @yield('header_js')
</head>
<body class="bg-light">
@yield('content')
@yield('footer_js')
</body>
</html>
