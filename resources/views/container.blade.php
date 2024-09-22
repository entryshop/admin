<!-- Container -->
<div {!! $renderable->wrapper() !!}>
    @foreach($renderable->children() as $child)
        <div {!! $child->wrapper() !!}>
            {!! render($child) !!}
        </div>
    @endforeach
</div>
