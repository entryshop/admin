@php
    $action = $renderable->get('action', '');
    $method = $renderable->get('method', 'post');
    $entity = $renderable->entity();
@endphp

<form action="{{$renderable->action() ?? ''}}" method="{{$method=='get' ? 'get':'post'}}" enctype="multipart/form-data">
    @csrf
    @method($renderable->method()??'post')
    @include('admin::partials.errors')
    <div>
        @foreach($renderable->children() as $child)
            <div {!! $child->wrapper()?? $renderable->get('default-item-wrapper') !!} id="field_{{$child->key()}}">
                {!! render($child, ['entity' => $entity]) !!}
            </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary">@lang('admin::crud.submit')</button>
</form>

@include('admin::crud.scripts.crud')
