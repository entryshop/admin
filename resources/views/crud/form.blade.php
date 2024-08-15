@php
    $action = $renderable->get('action', '');
    $method = $renderable->get('method', 'post');
    $entry = $renderable->entry();
@endphp

<form action="{{$renderable->action() ?? ''}}" method="{{$method=='get' ? 'get':'post'}}" enctype="multipart/form-data">
    @csrf
    @method($renderable->method()??'post')
    <div class="card">
        <div class="card-body">
            @include('admin::partials.errors')
            <div {!! $renderable->get('wrapper', 'class="d-flex flex-wrap gap-3"') !!}>
                @foreach($renderable->fields() as $child)
                    <div {!! $child->wrapper() !!}>
                        {!! $child->render(['entry' => $entry, 'value' => $child->value()]) !!}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">@lang('admin::crud.submit')</button>
        </div>
    </div>
</form>
