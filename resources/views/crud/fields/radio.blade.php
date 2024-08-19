@php
    $options = $renderable->options()??[];
    $id = $key ?? $name;
    $linkages = $renderable->linkages();
@endphp

@include('admin::components.fields.radio', [
    'name' => $name,
    'id' => $id,
    'value' => $renderable->value(),
    'options' => $options,
])

@if(!empty($linkages))
    @include('admin::crud.scripts.linkage', ['linkages' => $linkages, 'value' => $renderable->value()])
@endif
