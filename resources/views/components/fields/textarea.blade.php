@props([
    'class' => '',
    'name' => '',
    'id' => '',
    'rows' => 3,
])
<textarea id="{{$id}}" class="{{$class}}" name="{{$name}}"
          rows="{{$rows}}"
>@if(!empty($value)){{$value}}@endif</textarea>
