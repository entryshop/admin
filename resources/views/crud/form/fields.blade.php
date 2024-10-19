<div {!! $renderable->get('wrapper', 'class="d-flex flex-wrap gap-3"') !!}>
    @foreach($renderable->children() as $child)
        <div
            {!! $child->wrapper()?? $renderable->get('default-item-wrapper') !!} id="field_{{$child->key()}}">
            {!! render($child, ['entity' => $entity]) !!}
        </div>
    @endforeach
</div>
