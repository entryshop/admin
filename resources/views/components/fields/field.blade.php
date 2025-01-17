@props(['name','label','id','description'])
<label for="{{$id??''}}">{{ $label??'' }}</label>
@if($description ?? false)
    <p>{!! $description??'dsads' !!}</p>
@endif
{{$slot}}
<span class="text-danger error-message">
    @error($name)
    {{$message}}
    @enderror
</span>
