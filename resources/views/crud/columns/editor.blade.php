@if(empty($value))
    {{to_string($value)}}
@else
    {!! $value !!}
@endif
