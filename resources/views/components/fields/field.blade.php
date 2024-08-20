@props(['name','label','id'])
<label for="{{$id??''}}">{{$label??''}}</label>
{{$slot}}
@error($name)
<span class="text-center">{{$message}}</span>
@enderror
