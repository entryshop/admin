@php
    use Entryshop\Admin\Components\Crud\CrudPanel;
    $action = $renderable->get('action', '');
    $method = $renderable->get('method', 'post');
    $entity = $renderable->entity();
    $section_before_body = $renderable->children('before_body');
    $section_after_body = $renderable->children('after_body');
    $fields_only = $renderable->fields_only() ?? false;
@endphp

{!! render($renderable->children(CrudPanel::POSITION_BEFORE_CONTENT)) !!}

@if($fields_only)
    <div {!! $renderable->get('wrapper', 'class="d-flex flex-wrap gap-3"') !!}>
        @foreach($renderable->children() as $child)
            <div
                {!! $child->wrapper()?? $renderable->get('default-item-wrapper') !!} id="field_{{$child->key()}}">
                {!! render($child, ['entity' => $entity]) !!}
            </div>
        @endforeach
    </div>
@else
    <form action="{{$renderable->action() ?? ''}}" method="{{$method=='get' ? 'get':'post'}}"
          enctype="multipart/form-data">
        @csrf
        @method($renderable->method()??'post')
        <div class="card mb-0">
            <div class="card-body">
                @include('admin::partials.errors')
                <div {!! $renderable->get('wrapper', 'class="d-flex flex-wrap gap-3"') !!}>
                    @foreach($renderable->children() as $child)
                        <div
                            {!! $child->wrapper()?? $renderable->get('default-item-wrapper') !!} id="field_{{$child->key()}}">
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
@endif

{!! render($renderable->children(CrudPanel::POSITION_AFTER_CONTENT)) !!}

@include('admin::crud.scripts.crud')
