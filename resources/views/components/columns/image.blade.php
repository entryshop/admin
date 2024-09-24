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
<a id="{{$id}}" href="{{$src}}" target="_blank">
    <img src="{{$src}}" {!! $attributes ?? '' !!} >
</a>
@push('styles')
    <style nonce="{{admin()->csp()}}">
        #{{$id}} img {
            max-width: {{$width}}{{\Illuminate\Support\Str::contains('%', $width)?'':'px'}};
            max-height: {{$height}}{{\Illuminate\Support\Str::contains('%', $width)?'':'px'}};
            object-fit: {{$object_fit}};
        }
    </style>
@endpush
