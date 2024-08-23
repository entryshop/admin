@props([
    'width',
    'height',
    'name',
    'src',
    'object_fit' => 'contain',
])

@php
    $id = 'img_'.uniqid();
@endphp

<img src="{{$src}}" id="{{$id}}" {!! $attributes ?? '' !!} >

@push('styles')
    <style nonce="{{admin()->csp()}}">
        img#{{$id}} {
            max-width: {{$width}}{{\Illuminate\Support\Str::contains('%', $width)?'':'px'}};
            max-height: {{$height}}{{\Illuminate\Support\Str::contains('%', $width)?'':'px'}};
            object-fit: {{$object_fit}};
        }
    </style>
@endpush
