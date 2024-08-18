@php
    $icon ??= 'ri-edit-line';
    $size ??= 'xs';
    $color ??= 'ghost-primary';
    $label ??= __('admin::crud.edit');
    $href ??= $renderable->crud()->url('{entity.id}/edit');
@endphp

@include('admin::crud.buttons.button')
