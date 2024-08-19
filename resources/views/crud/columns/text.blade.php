@if(empty($value))
@else
    @if($escape??false)
        {!! $value !!}
    @else
        {{ $value }}
    @endif
@endif
