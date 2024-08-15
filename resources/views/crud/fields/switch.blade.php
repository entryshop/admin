<label for="{{$key}}">{{$label}}</label>
<x-admin::fields.switch :$name :value="$value??null" :id="$key"/>
