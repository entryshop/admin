@extends('admin::layouts.html')

@push('body')
    @stack('before_content')
    @stack('content')
    @foreach(admin()->children() as $child)
        {!! $child->render() !!}
    @endforeach
    @stack('after_content')
@endpush
