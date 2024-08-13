@extends('admin::layouts.html')

@push('body')
    @stack('before_content')
    @stack('content')
    @foreach(admin()->children() as $child)
        {!! render($child) !!}
    @endforeach
    @stack('after_content')
@endpush

@push('html_attributes')
    @foreach(admin()->themeVar() as $key => $value)
        {{$key}}="{{$value}}"
    @endforeach
@endpush
