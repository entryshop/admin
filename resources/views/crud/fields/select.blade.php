@php
    $options = $renderable->options();
    if(!empty($value) && empty($options)) {
        foreach ($value as $item) {
            $options[data_get($item, 'id')] = data_get($item, 'name');
        }
    }
    $id =   $key ?? $name;
@endphp

<label for="{{$id}}">{{$label}}</label>

@include('admin::components.fields.select', [
    'name' => $name,
    'id' => $id,
    'ajax' => $renderable->ajax(),
    'value' => $renderable->value(),
    'options' => $options,
    'multiple' => $renderable->multiple() ?? false,
    'placeholder' => $renderable->placeholder(),
])
