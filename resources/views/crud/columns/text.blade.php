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
        @if(empty($value))
            {{to_string($value)}}
        @else
            @if($escape??false)
                {!! $value !!}
            @else
                {{ $value }}
            @endif
        @endif
@if($link)
    </a>
@endif
