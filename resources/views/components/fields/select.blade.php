@props([
    'name',
    'id',
    'ajax' => null,
    'value' => null,
    'options' => [],
    'multiple' => false,
    'placeholder' => null,
    'max' => null,
    'allow_null'=> true,
])

@php
    if($multiple) {
        if(is_iterable($value)) {
            $value_keys = collect($value)->map(function ($item) {
                if(is_object($item)) {
                    return  data_get($item, 'id');
                }
                return $item;
            })->toArray();
        } else {
            $value_keys = [$value];
        }
    } else {
        $value_keys = [$value];
    }
@endphp

@if($ajax)
    <div class="d-flex gap-2 float-end">
        <a role="button" data-refresh-select data-id="{{$id}}" class="text-primary"><i class="ri-refresh-line"></i></a>
    </div>
@endif

<select id="{{$id}}"
        @if($ajax) data-ajax="{{$ajax}}" @endif
        data-select
        {{$multiple ? 'multiple':''}} class="form-select"
        name="{{$name}}{{$multiple ? '[]':''}}"
>
    @if(!empty($options))
        @if($allow_null)
            <option value="">{{$placeholder ?? __('admin::crud.please_select')}}</option>
        @endif
        @foreach($options as $_key => $_label)
            <option value="{{$_key}}"
                    @if(in_array($_key, $value_keys)) selected @endif
            >{!! $_label !!}</option>
        @endforeach
    @endif
</select>



@push('scripts')

    <script nonce="{{admin()->csp()}}">
        let choice_{{$id}} = new Choices('#{{$id}}', {
            allowHTML: true,
            removeItemButton: true,
            shouldSort: false,
            @if($placeholder)
            placeholder: true,
            placeholderValue: '{{$placeholder}}',
            @endif
                    @if($max)
            maxItemCount: {{$max}},
            @endif
        });

        // 调整 Choices 容器宽度以适应内容
        const container = document.querySelector('#{{$id}}').closest('.choices');
        const dropdown = container.querySelector('.choices__list--dropdown');
        
        // 获取最大选项宽度
        let maxWidth = 0;
        const items = dropdown.querySelectorAll('.choices__item');
        items.forEach(item => {
            const width = item.offsetWidth;
            maxWidth = Math.max(maxWidth, width);
        });
        
        // 设置容器宽度
        container.style.width = (maxWidth + 50) + 'px'; // 额外添加一些空间用于箭头和内边距

        @if($ajax)
        choice_{{$id}}.setChoices(function () {
            return fetch('{{$ajax}}')
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    return data;
                });
        });
        @endif
    </script>
@endpush
