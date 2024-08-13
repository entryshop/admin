<div {!! $builder->wrapper() !!}>
    @foreach($builder->children()??[] as $child)
        <div {!! $child->wrapper() !!}>
            {!! $child->render() !!}
        </div>
    @endforeach
</div>
