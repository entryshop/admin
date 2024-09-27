@php
    $id = $renderable->key() ?? $renderable->name();
@endphp
<x-admin::fields.field :$name :$id :label="$label??''">
    <div id="jsoneditor_{{$name}}"></div>
    <input type="hidden" name="{{$name}}" value="{{$value??"[]"}}">
</x-admin::fields.field>

@once
    @push('styles')
        <link href="{{admin()->asset('libs/jsoneditor/jsoneditor.min.css')}}" rel="stylesheet" type="text/css">
    @endpush

    @push('scripts')
        <script src="{{admin()->asset('libs/jsoneditor/jsoneditor.min.js')}}"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        // create the editor
        const editor_{{$name}} = new JSONEditor(document.getElementById("jsoneditor_{{$name}}"), {});

        // set json
        editor_{{$name}}.set(@json(to_json($value??[])))

        // get json
        const updatedJson = editor_{{$name}}.get()
    </script>
@endpush
