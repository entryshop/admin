@php
    $options = $renderable->options()??[];
    $id = $key ?? $name;
    $linkages = $renderable->linkages();
@endphp

<x-admin::fields.field :$name :$id :label="$label??''">
    @include('admin::components.fields.radio', [
        'name' => $name,
        'id' => $id,
        'value' => $renderable->value(),
        'options' => $options,
    ])
</x-admin::fields.field>

@if(!empty($linkages))
    @include('admin::crud.scripts.linkage', ['linkages' => $linkages, 'value' => $renderable->value()])
    @push('after_scripts')
        <script nonce="{{admin()->csp()}}">
            $("input[name={{$name}}]").on('change', function () {
                valueChanged($(this).val());
            });
            @if(isset($value))
            valueChanged("{{$value}}");
            @endif
        </script>
    @endpush
@endif


