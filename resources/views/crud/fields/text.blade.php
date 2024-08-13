<label for="{{$key}}">{{$label}}</label>
<input id="{{$key}}" class="form-control" type="text" name="{{$name}}"
       @if(!empty($value)) value="{{$value}}" @endif
>
