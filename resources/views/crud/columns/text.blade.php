@php
    $value = interpolate($value, $renderable->getContext());
    if(!empty($href)) {
        $link = true;
        $href = interpolate($href, $renderable->getContext());
        $target = $target??'_self';
    } else {
        $link = false;
    }
@endphp

@if($link)
    <a href="{{$href}}" target="{{$target}}">
@endif
        @if($escape??false)
            {!! to_string($value) !!}
        @else
            {{ to_string($value) }}
        @endif
@if($link)
    </a>
@endif
