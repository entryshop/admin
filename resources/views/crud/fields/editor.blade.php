@php
    $id = $renderable->key() ?? $renderable->name();
    $value??='';
@endphp

<x-admin::fields.tinymce :$id :$name :$value/>
