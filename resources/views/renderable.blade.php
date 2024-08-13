@if(is_string($renderable))
    {!! $renderable !!}
@elseif($renderable->has('display'))
    {!! $renderable->display() !!}
@else
    @include($renderable->getView(), array_merge(['renderable'=> $renderable], $renderable->getViewData()))
@endif
