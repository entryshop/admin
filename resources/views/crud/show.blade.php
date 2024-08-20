@php
    $inline_buttons = $renderable->buttons('inline');
    $section_before_header = $renderable->children('before_header');
    $section_after_header = $renderable->children('after_header');
    $section_before_body = $renderable->children('before_header');
    $section_after_body = $renderable->children('section_after_body');
@endphp

<div class="card">
    @if(!empty($section_before_header))
        {!! render($section_before_header) !!}
    @endif

    @if(count($inline_buttons))
        <div class="card-header">
            <x-admin::flex :wrap="false" :items="$inline_buttons" gap="2"
                           :params="['entity'=>$renderable->entity()]"/>
        </div>
    @endif

    @if(!empty($section_after_header))
        {!! render($section_after_header) !!}
    @endif

    <div class="card-body">
        @if(!empty($section_before_body))
            {!! render($section_before_body) !!}
        @endif
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
        @if(!empty($section_after_body))
            {!! render($section_after_body) !!}
        @endif
    </div>
</div>

@include('admin::crud.scripts.crud')
