@foreach($renderable->children() as $child)
    {!! render($child) !!}
@endforeach
