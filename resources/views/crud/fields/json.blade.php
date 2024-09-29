@php
    $id = $renderable->key() ?? $renderable->name();
    $value = to_json($value??[]);

    $mode = $renderable->mode() ?? 'tree';
    $modes = $renderable->modes() ??['code', 'tree', 'form', 'view', 'preview'];
@endphp
<x-admin::fields.field :$name :$id :label="$label??''">
    <div id="jsoneditor_{{$name}}"></div>
    <input type="hidden" name="{{$name}}" value="{{json_encode($value)}}">
</x-admin::fields.field>

@once
    @push('styles')
        <link nonce="{{admin()->csp()}}" href="{{admin()->asset('libs/jsoneditor/jsoneditor.min.css')}}"
              rel="stylesheet" type="text/css">
        <style nonce="{{admin()->csp()}}">
            .jsoneditor-menu {
                background-color: var(--vz-primary) !important;
                border-bottom: 1px solid var(--vz-primary) !important;
            }

            .jsoneditor {
                border: thin solid var(--vz-primary) !important;
            }

            .jsoneditor-contextmenu .jsoneditor-menu button {
                color: #cfcfcf !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script nonce="{{admin()->csp()}}" src="{{admin()->asset('libs/jsoneditor/jsoneditor.min.js')}}"></script>
    @endpush
@endonce

@push('scripts')
    <script nonce="{{admin()->csp()}}">
        // create the editor
        const editor_{{$name}} = new JSONEditor(document.getElementById("jsoneditor_{{$name}}"), {
            onChangeText: function (changedText) {
                document.querySelector('input[name="{{$name}}"]').value = changedText;
            },
            mode: "{{$mode??'tree'}}",
            modes: @json($modes),
        });
        // set json
        editor_{{$name}}.set(@json($value));
    </script>
@endpush
