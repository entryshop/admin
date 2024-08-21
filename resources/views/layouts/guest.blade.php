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
    @foreach(admin()->theme() as $key => $value)
        {{$key}}="{{$value}}"
    @endforeach
@endpush

@push('styles')
    <style nonce="{{admin()->csp()}}">
        body {
            overflow-x: hidden;
        }
    </style>
@endpush
