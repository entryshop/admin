<!-- Container -->
<div {!! $renderable->wrapper() !!}>
    @foreach($renderable->children() as $child)
        <div {!! $child->wrapper() ?? 'class="'.$renderable->get('default_child_class').'"' !!}>
            {!! render($child) !!}
        </div>
    @endforeach
</div>
