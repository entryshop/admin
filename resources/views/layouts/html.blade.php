<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @stack('html_attributes')>
<head>
    @stack('before_head')
    @include('admin::partials.head')
    @stack('after_head')
</head>
<body @stack('body_attributes')>
@stack('before_body')
@stack('body')
@include('admin::partials.scripts')
@stack('after_body')
</body>
</html>
