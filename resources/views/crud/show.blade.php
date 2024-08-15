<div class="card">
    <div class="card-header">
        @include('admin::crud.inc.buttons', ['buttons' => $renderable->buttons('inline'), 'row' => $renderable->entry()])
    </div>
    <div class="card-body">
        <div {!! $renderable->wrapper() ?? 'class="d-flex flex-wrap gap-3"' !!} >
            @foreach($renderable->columns() as $column)
                <div {!! $column->wrapper()?? $renderable->get('default-item-wrapper') !!}>
                    <label class="text-muted">{{$column->getLabel()}}</label>
                    <div>
                        {!! $column->render(['row' => $renderable->entry()]) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('admin::crud.scripts.crud')
