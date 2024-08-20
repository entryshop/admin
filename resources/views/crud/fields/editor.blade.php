@php
    $id = $renderable->key() ?? $renderable->name();
    $value??='';
@endphp

<x-admin::fields.field :$name :$id :label="$label??''">
    <x-admin::fields.tinymce :$id :$name :$value/>
</x-admin::fields.field>
