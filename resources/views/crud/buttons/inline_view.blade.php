@php
    $icon ??= 'ri-eye-line';
    $size ??= 'xs';
    $color ??= 'ghost-primary';
    $label ??= __('admin::crud.preview');
    $href ??= $renderable->crud()->url('{entity.id}');
@endphp

@include('admin::crud.buttons.button')
