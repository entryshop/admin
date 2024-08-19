@props([
    'type' => 'text',
    'class' => '',
    'name' => '',
    'id' => '',
    'value' => null,
    'options' => [],
])

<div class="d-flex gap-2 flex-wrap align-items-bottom">
    @foreach($options as $key=>$label)
        <div class="form-check">
            <input class="form-check-input" type="radio" id="{{$id}}_{{$loop->index}}" name="{{$name}}"
                   @if($value===$key) checked @endif
                   value="{{$key}}"/>
            <label class="form-check-label" role="button" for="{{$id}}_{{$loop->index}}">{{$label}}</label>
        </div>
    @endforeach
</div>
