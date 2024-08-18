@php
    $inline_buttons = $renderable->buttons('inline');
@endphp

<div class="card">
    @if(count($inline_buttons))
        <div class="card-header">
            <x-admin::flex :wrap="false" :items="$inline_buttons" gap="2"
                           :params="['entity'=>$renderable->entity()]"/>
        </div>
    @endif
    <div class="card-body">
        <div {!! $renderable->wrapper() ?? 'class="d-flex flex-wrap gap-3"' !!} >
            @foreach($renderable->columns() as $column)
                <div {!! $column->wrapper()?? $renderable->get('default-item-wrapper') !!}>
                    <label class="{{$renderable->get('label_class', 'text-muted')}}">{{$column->getLabel()}}</label>
                    <div class="{{$renderable->get('column_class')}}">
                        {!! render($column, ['entity' => $renderable->entity()]) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('admin::crud.scripts.crud')
