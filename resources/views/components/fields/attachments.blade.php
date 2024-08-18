@props([
    'name',
    'multiple' => true,
    'value' => [],
    'upload_url' =>  admin()->getUploadUrl(),
])

<div x-data="attachments_{{$name}}">
    <input type="file" {{$multiple?'multiple':''}} class="form-control" id="upload_{{$name}}">
    <div class="mt-1">
        <ul class="list-group">
            <template x-for="(file,index) in file_list">
                <li class="list-group-item" :key="index">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded">
                                        <i class="ri-file-line"></i>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <h6 class="fs-14 mb-0">
                                        <a :href="file.url" x-text="file.name" target="_blank"></a>
                                    </h6>
                                    <small class="text-muted" x-text="file.type"></small>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <a role="button" x-on:click="deleteFile"
                               :data-index="index"
                               class="btn btn-ghost-danger btn-sm">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
    <input type="hidden" class="form-control" name="{{$name}}" x-model="json_value_string">
</div>

@pushonce('scripts')
    <script defer nonce="{{admin()->csp()}}" src="{{admin()->asset('libs/@alpinejs/csp/cdn.min.js')}}"></script>
    <script nonce="{{admin()->csp()}}">
        document.addEventListener('alpine:init', () => {
            Alpine.data('attachments_{{$name}}', () => {
                return {
                    init() {
                        let _this = this;
                        $('#upload_{{$name}}').on('change', function () {
                            _this.submit();
                        });
                    },
                    file_list: @json(to_json($value??[])),
                    json_value_string: '',
                    submit(event) {
                        if (event) {
                            event.preventDefault();
                        }
                        let _this = this;
                        const formData = new FormData();
                        const files = $('#upload_{{$name}}')[0].files;
                        for (let i = 0; i < files.length; i++) {
                            formData.append("file{{$multiple?'[]':''}}", files[i]);
                        }
                        // upload file
                        $.ajax({
                            url: '{{$upload_url}}',
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                @if($multiple)
                                _this.file_list.push(...data);
                                @else
                                _this.file_list.push(data);
                                @endif
                                _this.updateJsonValue();
                                $('#upload_{{$name}}').val('');
                            },
                            error: function (data) {
                                console.log(data);
                            }
                        });
                    },
                    deleteFile(event) {
                        if (event) {
                            event.preventDefault();
                        }
                        let index = $(event.target).data('index')
                        this.file_list.splice(index, 1);
                        this.updateJsonValue();
                    },
                    updateJsonValue() {
                        this.json_value_string = JSON.stringify(this.file_list);
                    }
                }
            })
        })
    </script>
@endpushonce
