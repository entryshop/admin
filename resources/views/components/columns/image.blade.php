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

@pushonce('styles')
    <style nonce="{{admin()->csp()}}">
        #{{$id}} {
            max-width: {{$width}}{{\Illuminate\Support\Str::contains('%', $width)?'':'px'}};
            max-height: {{$height}}{{\Illuminate\Support\Str::contains('%', $width)?'':'px'}};
            object-fit: {{$object_fit}};
        }
    </style>
@endpushonce
