@php
    if($stack??false)
    {
        $value = to_json($value);
        $image_key ??= 'url';
    }
@endphp
@if($stack??false)
    <div>
        @foreach($value as $_value)
            <x-admin::columns.image
                :src="$_value[$image_key]?:$defaultImageUrl"
                :width="$width??null"
                :height="$height??null"
                :object_fit="$object_fit??'contain'"
            />
            @if(($limit??false) && $loop->iteration >= $limit)
                @break
            @endif
        @endforeach
    </div>
@else
    <x-admin::columns.image
        :src="$value?:$defaultImageUrl"
        :width="$width??null"
        :height="$height??null"
        :object_fit="$object_fit??'contain'"
    />
@endif
