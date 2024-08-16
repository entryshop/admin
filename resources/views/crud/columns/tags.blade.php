@php
    $tags = $value->pluck('name', 'id');
@endphp

<x-admin::columns.tags :tags="$tags" :max="$max??null" :colors="$colors??[]"/>
