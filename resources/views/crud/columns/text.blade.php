@if(empty($value))
    @dump($renderable)
@else
    @if($escape??false)
        {!! $value !!}
    @else
        {{ $value }}
    @endif
@endif
