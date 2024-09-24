@php
    $href = interpolate($href, $renderable->getContext());
    $value = interpolate($value, $renderable->getContext());
@endphp

@if(empty($value))
    {{to_string($value)}}
@else
    <a href="{{$href??'#'}}" target="{{$target??'_self'}}">
        @if($escape??false)
            {!! $value !!}
        @else
            {{ $value }}
        @endif
    </a>
@endif
