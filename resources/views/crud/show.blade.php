@php
    $inline_buttons = $renderable->buttons('inline');
@endphp

<div class="card">
    @if(count($inline_buttons))
        <div class="card-header">
            @include('admin::crud.inc.buttons', ['buttons' => $inline_buttons, 'row' => $renderable->entry()])
        </div>
    @endif
    <div class="card-body">
        <div {!! $renderable->wrapper() ?? 'class="d-flex flex-wrap gap-3"' !!} >
            @foreach($renderable->columns() as $column)
                <div {!! $column->wrapper()?? $renderable->get('default-item-wrapper') !!}>
                    <label class="{{$renderable->get('label_class', 'text-muted')}}">{{$column->getLabel()}}</label>
                    <div class="{{$renderable->get('column_class')}}">
                        {!! $column->render(['row' => $renderable->entry()]) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('admin::crud.scripts.crud')
