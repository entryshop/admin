@props(['name','label','id'])
<label for="{{$id??''}}">{{$label??''}}</label>
{{$slot}}
<span class="text-danger error-message">
    @error($name)
    {{$message}}
    @enderror
</span>
