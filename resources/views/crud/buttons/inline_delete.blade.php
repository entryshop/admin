@php
    $method ??= 'delete';
    $icon ??= 'ri-delete-bin-line';
    $size ??= 'xs';
    $color ??= 'ghost-danger';
    $label ??= __('admin::crud.delete');
    $confirm ??= __('admin::crud.delete_confirm');
    $action ??= $renderable->crud()->url($entity->getKey());
@endphp

@include('admin::crud.buttons.button')
