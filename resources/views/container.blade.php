<div {!! $renderable->wrapper() !!}>
    @foreach($renderable->children() as $child)
        <div {!! $renderable->wrapper() !!}>
            {!! render($child) !!}
        </div>
    @endforeach
</div>
