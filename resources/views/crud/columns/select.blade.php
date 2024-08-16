@php
    $options ??=[];
    $colors ??=[];
    $label = $options[$value] ?? $value;
    $color = $colors[$value] ?? ($colors['_default'] ?? ($color??null));
@endphp

<x-admin::columns.label :$label :$color/>
