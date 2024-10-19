@php
    use Entryshop\Admin\Components\Crud\CrudPanel;
    $action = $renderable->get('action', '');
    $method = $renderable->get('method', 'post');
    $entity = $renderable->entity();
    $fields_only = $renderable->fields_only() ?? false;
@endphp

{!! render($renderable->children(CrudPanel::POSITION_BEFORE_CONTENT)) !!}

@if($fields_only)
    @include('admin::crud.form.fields')
@else
    <form action="{{$renderable->action() ?? ''}}" method="{{$method=='get' ? 'get':'post'}}"
          enctype="multipart/form-data">
        @csrf
        @method($renderable->method()??'post')
        <div class="card mb-0">
            <div class="card-body">
                @include('admin::partials.errors')
                @include('admin::crud.form.fields')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">@lang('admin::crud.submit')</button>
            </div>
        </div>
    </form>
@endif

{!! render($renderable->children(CrudPanel::POSITION_AFTER_CONTENT)) !!}

@include('admin::crud.scripts.crud')
