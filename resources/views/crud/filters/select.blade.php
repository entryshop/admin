@php
    $id = $key ?? $name;
    $options = $renderable->options();
@endphp

@include('admin::components.fields.select', [
    'name' => $name,
    'id' => $id,
    'ajax' => $renderable->ajax(),
    'value' => request($name),
    'options' => $options,
    'multiple' => $renderable->multiple() ?? false,
    'placeholder' => $renderable->placeholder() ?? $renderable->getLabel(),
])
