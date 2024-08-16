@props([
    'size' => null,
    'color' => 'primary',
    'data' => [],
    'action',
    'label',
    'icon',
    'href',
    'target',
])
@php
    if(!empty($href)) {
        $element = 'a';
    } else {
        $element = 'button';
    }
@endphp

<{{$element}} class="btn {{$size? 'btn-'.$size:''}} btn-{{$color}}" {!! $attributes??'' !!}
@if(!empty($href))
    href="{{$href}}" target="{{$target ?? '_self'}}"
@endif
>
@if(!empty($icon))
    <i class="{{$icon}} align-bottom me-1"></i>
@endif @if($label)
    {{$label}}
@endif
</{{$element}}>
