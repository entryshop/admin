@if(empty($value))
    {{to_string($value)}}
@else
    @if($escape??false)
        {!! $value !!}
    @else
        {{ $value }}
    @endif
@endif
