@php
    use \Entryshop\Admin\Components\Crud\CrudPanel;
    $inline_buttons = $renderable->buttons('inline');
    $section_before_content = $renderable->children(CrudPanel::POSITION_BEFORE_CONTENT);
    $section_after_content = $renderable->children(CrudPanel::POSITION_AFTER_CONTENT);

    $section_before_header = $renderable->children(CrudPanel::POSITION_BEFORE_HEADER);
    $section_after_header = $renderable->children(CrudPanel::POSITION_AFTER_HEADER);

    $section_before_body = $renderable->children(CrudPanel::POSITION_BEFORE_BODY);
    $section_after_body = $renderable->children(CrudPanel::POSITION_AFTER_BODY);

    $section_before_footer = $renderable->children(CrudPanel::POSITION_BEFORE_FOOTER);
    $section_after_footer = $renderable->children(CrudPanel::POSITION_AFTER_FOOTER);
@endphp

{!! render($section_before_content) !!}

<div class="card mb-0">

    @if(count($inline_buttons) || !empty($section_before_header) || !empty($section_after_header))
        <div class="card-header">
            {!! render($section_before_header) !!}
            <x-admin::flex :wrap="false" :items="$inline_buttons" gap="2"
                           :params="['entity'=>$renderable->entity()]"/>
            {!! render($section_after_header) !!}
        </div>
    @endif

    <div class="card-body">
        {!! render($section_before_body) !!}
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
        {!! render($section_after_body) !!}
    </div>

    @if(!empty($section_before_footer) || !empty($section_after_footer))
        <div class="card-footer">
            {!! render($section_before_footer) !!}
            {!! render($section_after_footer) !!}
        </div>
    @endif
</div>

{!! render($section_after_content) !!}

@include('admin::crud.scripts.crud')
