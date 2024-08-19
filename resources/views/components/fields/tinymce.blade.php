@props([
    'id',
    'name',
    'value',
])

<div id="editor_{{$id}}"></div>
<input name="{{$name}}" id="{{$id}}" type="hidden" value="{{$value}}"/>

@once
    @push('scripts')
        <script src="{{admin()->asset('libs/tinymce/tinymce.min.js')}}"></script>
        <script nonce="{{admin()->csp()}}">
            const shadow_{{$id}} = document.getElementById('editor_{{$id}}').attachShadow({mode: 'open'});
            const node_{{$id}} = document.createElement('textarea');
            node_{{$id}}.append(`{!! $value !!}`);
            shadow_{{$id}}.appendChild(node_{{$id}});
            tinymce.init({
                license_key: 'gpl',
                target: node_{{$id}},
                setup: function (editor) {
                    editor.on('Change', function (e) {
                        $('input[id={{$id}}]').val(editor.getContent());
                    });

                    window.addEventListener('set_content_{{$id}}', function (e) {
                        if (e.detail.content) {
                            editor.setContent(e.detail.content);
                        }
                    });
                },
                height: "200",
                plugins: 'fullscreen anchor code autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo |blocks fontfamily fontsize |backcolor forecolor | bold italic underline strikethrough |code fullscreen link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons | removeformat',
                menubar: false,
                images_upload_url: '/admin/upload?key=location',
                custom_elements: "style"
            });
        </script>
    @endpush
@endonce
