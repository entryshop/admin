@props([
    'name',
    'multiple' => true,
    'value' => [],
    'upload_url' =>  admin()->getUploadUrl(),
])

<div x-data="attachments_{{$name}}">
    <div class="mt-1">
        <ul class="list-group">
            <template x-for="(file,index) in file_list">
                <li class="list-group-item" :key="index">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded">
                                        <template x-if="file.is_image">
                                            <img :src="file.url" class="w-100 h-100 object-fit-cover">
                                        </template>
                                        <template x-if="file.preview_icon">
                                            <i :class="file.preview_icon"></i>
                                        </template>
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
                            <a class="btn btn-sm btn-ghost-primary" :href="file.url" download><i
                                    class="ri-download-2-line"></i></a>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</div>

@include('admin::components.partials.file_icons')

@pushonce('scripts')
    <script defer nonce="{{admin()->csp()}}" src="{{admin()->asset('libs/@alpinejs/csp/cdn.min.js')}}"></script>
    <script nonce="{{admin()->csp()}}">
        document.addEventListener('alpine:init', () => {
            Alpine.data('attachments_{{$name}}', () => {
                return {
                    init() {
                        let _this = this;
                        this.file_list = mapFilePreviewIcon(this.file_list);
                    },
                    file_list: @json(to_json($value??[])),
                }
            })
        })
    </script>
@endpushonce
