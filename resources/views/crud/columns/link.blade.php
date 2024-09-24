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
