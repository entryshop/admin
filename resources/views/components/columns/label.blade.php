@props([
    'color' => null,
    'label' => null,
    'icon' => null,
])

<span class="{{$color ? 'badge bg-'.$color : ''}}" {!! $attributes??'' !!}>
    @if($icon)
        <i class="{{$icon}} align-bottom"></i>
    @endif
    @if($label)
        {!! $label !!}
    @endif
</span>
