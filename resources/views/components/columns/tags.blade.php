@props([
    'tags' => [],
    'colors' => [],
    'max' => null,
])

<div class="d-flex flex-wrap gap-1">
    @foreach($tags as $key => $value)
        <span class="badge bg-{{$colors[$key??$value] ?? 'primary'}}">{{$value}}</span>
        @if(!empty($max))
            @if($loop->index +1 >= $max)
                @if(count($tags) > $max)
                    <span class="badge bg-primary-subtle">+ {{count($tags) - $max}}</span>
                @endif
                @break
            @endif
        @endif
    @endforeach
</div>
