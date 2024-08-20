@php
    $options = $renderable->options()??[];
    $id = $key ?? $name;
    $linkages = $renderable->linkages();
@endphp

<x-admin::fields.field :$name :$id :label="$label??''">
    @include('admin::components.fields.radio', [
        'name' => $name,
        'id' => $id,
        'value' => $renderable->value(),
        'options' => $options,
    ])
</x-admin::fields.field>

@if(!empty($linkages))
    @include('admin::crud.scripts.linkage', ['linkages' => $linkages, 'value' => $renderable->value()])
@endif
