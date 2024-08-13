<button {!! $renderable->wrapper() !!}>
    @if($icon = $renderable->icon())
        <i class="{{$icon}}"></i>
    @endif
    {{$label}}
</button>
