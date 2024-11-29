@props([
    'type' => 'text',
    'class' => '',
    'name' => '',
    'id' => '',
    'value' => null,
    'options' => [],
    'native_type' => 'radio',
])

<div>
    @foreach($options as $_key=>$_label)
        @php
            if(is_array($_label)) {
                $option = $_label;
             } else {
                $option = [
                    'value'  => $_key,
                    'label' => $_label,
                ];
             }
        @endphp
        <div class="form-check {{($inline??false)?'form-check-inline':''}}
                @if($option['color']??($color??null))
                    form-check-{{$option['color']??$color}}
                @endif">
            <input class="form-check-input" type="{{$native_type}}" id="{{$id}}_{{$loop->index}}" name="{{$name}}"
                   @if($value===$option['value']) checked @endif
                   value="{{$option['value']}}"/>
            <label class="form-check-label" role="button" for="{{$id}}_{{$loop->index}}">{{$option['label']}}</label>
        </div>
    @endforeach
</div>
