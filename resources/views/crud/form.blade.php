@php
    $action = $renderable->get('action', '');
    $method = $renderable->get('method', 'post');
    $entity = $renderable->entity();
@endphp

<form action="{{$renderable->action() ?? ''}}" method="{{$method=='get' ? 'get':'post'}}" enctype="multipart/form-data">
    @csrf
    @method($renderable->method()??'post')
    <div class="card mb-0">
        <div class="card-body">
            @include('admin::partials.errors')
            <div {!! $renderable->get('wrapper', 'class="d-flex flex-wrap gap-3"') !!}>
                @foreach($renderable->children() as $child)
                    <div {!! $child->wrapper()?? $renderable->get('default-item-wrapper') !!} id="field_{{$child->key()}}">
                        {!! render($child, ['entity' => $entity]) !!}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">@lang('admin::crud.submit')</button>
        </div>
    </div>
</form>

@include('admin::crud.scripts.crud')
