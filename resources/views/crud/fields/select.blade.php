@php
    $options = $renderable->options();
    if(!empty($value) && empty($options)) {
        foreach ($value as $item) {
            $options[data_get($item, 'id')] = data_get($item, 'name');
        }
    }
    $id = $key ?? $name;
    $linkages = $renderable->linkages();
@endphp

<x-admin::fields.field :$name :$id :label="$label??''">
    <x-admin::fields.select :$name :id="$id"
        :ajax="$renderable->ajax()"
        :options="$renderable->options()"
        :multiple="$renderable->multiple()??false"
        :placeholder="$placeholder??null"
        :value="$renderable->value()"
    />
</x-admin::fields.field>

@if(!empty($linkages))
    @include('admin::crud.scripts.linkage', ['linkages' => $linkages, 'value' => $renderable->value()])
    @push('scripts')
        <script nonce="{{admin()->csp()}}">
            choice_{{$id}}.passedElement.element.addEventListener('change', function (event) {
                valueChanged(event.detail.value);
            });

            @if(!empty($value))
            valueChanged("{{$value}}");
            @endif
        </script>
    @endpush
@endif


