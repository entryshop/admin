@php
    $id = $renderable->key() ?? $renderable->name();
@endphp

<x-admin::fields.tinymce :$id :$name :$value/>
