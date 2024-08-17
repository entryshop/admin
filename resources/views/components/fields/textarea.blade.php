@props([
    'class' => '',
    'name' => '',
    'id' => '',
    'value' =>'',
    'rows' => 3,
])
<textarea id="{{$id}}" class="{{$class}}" name="{{$name}}"
          rows="{{$rows}}"
>@if(!empty($value)){{$value}}@endif</textarea>
