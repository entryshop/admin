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
            @if($multiple)
                @if(is_object($value[0]??null))
                    @if(in_array($_key, $value->pluck('id')->toArray())) selected @endif
                @else
                    @if(in_array($_key, $value??[])) selected  @endif
                @endif
            @else
                {{$value == $_key ? 'selected':''}}
            @endif
            >{!! $_label !!}</option>
        @endforeach
    @endif
</select>

@push('scripts')
    <script nonce="{{admin()->csp()}}">
        let choice_{{$id}} = new Choices('#{{$id}}', {
            allowHTML: true,
            removeItemButton: true,
            @if($placeholder)
            placeholder: true,
            placeholderValue: '{{$placeholder}}',
            @endif
                @if($max)
            maxItemCount: {{$max}},
            @endif
        });

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
