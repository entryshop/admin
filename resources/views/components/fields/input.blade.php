@props([
    'type' => 'text',
    'class' => '',
    'name' => '',
    'id' => '',
    'value' => null,
    'placeholder' => null,
    'step' => 1,
    'prefix' => null,
    'suffix' => null,
])
@if($prefix || $suffix)
    <div class="input-group mb-3">
@endif
    @if($prefix)
        <span class="input-group-text">{!! $prefix !!}</span>
    @endif

    <input id="{{$id}}"
           step="{{$step}}"
           class="{{$class}}"
           type="{{$type}}"
           @if($placeholder) placeholder="{{$placeholder}}" @endif
           name="{{$name}}"
           value="{{$value}}">

    @if($suffix)
        <span class="input-group-text">{!! $suffix !!}</span>
    @endif

@if($prefix || $suffix)
    </div>
@endif
