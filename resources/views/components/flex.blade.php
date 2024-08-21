@props([
    'direction' => 'row',
    'wrap' => true,
    'gap' => 3,
    'params' => null,
    'items' => [],
])
<div class="d-flex flex-{{$direction}} gap-{{$gap}} {{$wrap ? 'flex-wrap':''}}">
    @foreach($items as $item)
        <div {!! $item->wrapper() !!}>
            {!! render($item, $params) !!}
        </div>
    @endforeach
</div>
