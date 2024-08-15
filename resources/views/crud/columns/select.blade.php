@php
    $options ??=[];
    $colors ??=[];
    $label = $options[$value] ?? $value;
    $color = $colors[$value] ?? ($colors['__default'] ?? null);
@endphp

<span class="@if(!empty($color)) badge bg-{{$color}}-subtle text-{{$color}} @endif">
    {{$label}}
</span>
