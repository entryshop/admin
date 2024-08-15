<label for="{{$key}}">{{$label}}</label>
<x-admin::fields.input :$name :value="$value??null" :id="$key" type="text" class="form-control"/>
