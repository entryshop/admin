@props([
    'size' => null,
    'action',
    'data' => [],
    'label',
    'icon',
    'color' => 'primary',
    'href'=>null,
    'target',
])
@php
    if(!empty($href)) {
        $element = 'a';
    } else {
        $element = 'button';
    }
    foreach ($__data['attributes'] as $key => $value) {
        if(\Illuminate\Support\Str::startsWith($key, 'data-')) {
            $data[$key] = $value;
        }
    }
@endphp

<{{$element}} class="btn {{$size? 'btn-'.$size:''}} btn-{{$color}}"
@foreach($data as $key => $value)
    {{$key}}="{{$value}}"
@endforeach
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
