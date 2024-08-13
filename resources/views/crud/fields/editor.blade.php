@php
    $id = $renderable->key() ?? $renderable->name();
@endphp

<label>{{$renderable->label()}}</label>

<x-admin::fields.tinymce
    :$id :$name :$value
/>
