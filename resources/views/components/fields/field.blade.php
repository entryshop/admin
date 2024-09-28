@props(['name','label','id'])
<label for="{{$id??''}}">{{$label??''}}</label>
{{$slot}}
<span class="text-danger invalid-feedback">
    @error($name)
    {{$message}}
    @enderror
</span>

