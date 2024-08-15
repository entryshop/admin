@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'label' => null,
    'checked_value' => 1,
])

@php
    $checked = (bool) $value;
@endphp

<div class="form-check form-switch ">
    <input {{$checked?'checked':''}} value="{{$checked_value}}"
           class="form-check-input" type="checkbox" role="switch" name="{{ $name }}"
           id="{{ $id }}">
</div>
