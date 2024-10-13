@props([
    'type' => 'text',
    'class' => '',
    'name' => '',
    'id' => '',
    'value' => null,
    'step' => 1,
])

<input id="{{$id}}" step="{{$step}}" class="{{$class}}" type="{{$type}}" name="{{$name}}" value="{{$value}}">
