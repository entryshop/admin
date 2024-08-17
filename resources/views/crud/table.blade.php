@php
    use Entryshop\Admin\Crud\CrudPanel;
    $top_buttons = $renderable->buttons('top');
    $inline_buttons = $renderable->buttons('inline');
    $bulk_buttons = $renderable->buttons('bulk');
    $section_before_table = $renderable->children(CrudPanel::CHILD_POSITION_BEFORE_TABLE);
    $section_after_table = $renderable->children(CrudPanel::CHILD_POSITION_AFTER_TABLE);
    $section_before_header = $renderable->children('before_header');
    $filters = $renderable->filters();
    $rows = $renderable->entries();

    if(method_exists($rows, 'paginate')) {
        $rows = $rows->paginate(10);
    }
@endphp

<div class="card">
    @if(!empty($section_before_header))
        {!! render($section_before_header) !!}
    @endif
    @if(!empty($top_buttons) || !empty($bulk_buttons) || !empty($filters))
        <div class="card-header">
            <div data-filters class="d-flex justify-content-between align-items-center">
                @if(!empty($filters))
                    <form class="d-flex flex-wrap gap-2">
                        <x-admin::flex :items="$filters" gap="1"/>
                        <div>
                            <button class="btn btn-primary"><i class="ri-search-2-line"></i></button>
                        </div>
                    </form>
                @endif
                @if(!empty($top_buttons))
                    <x-admin::flex :items="$top_buttons"/>
                @endif
            </div>
            @if(!empty($bulk_buttons))
                <div data-bulks class="d-none">
                    <x-admin::flex :items="$bulk_buttons"/>
                </div>
            @endif
        </div>
    @endif
    @if(!empty($section_before_table))
        {!! render($section_before_table) !!}
    @endif
    <div class="table-responsive">
        <table class="table mb-0 table-hover table-crud" id="{{$name}}">
            <thead>
            @if(count($bulk_buttons))
                <th class="w-24px">
                    <div class="form-check">
                        <input class="form-check-input row-select-all" type="checkbox">
                    </div>
                </th>
            @endif
            @foreach($renderable->columns() as $column)
                <th>{{$column->getLabel()}}</th>
            @endforeach
            @if(!empty($inline_buttons))
                <th>@lang('admin::crud.actions')</th>
            @endif
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr {!! $renderable->get('row_attrs') !!} data-id="{{$row->getKey()}}">
                    @if(count($bulk_buttons))
                        <td>
                            <div class="form-check">
                                <input class="form-check-input row-select" type="checkbox"
                                       data-id="{{$row->getKey()}}">
                            </div>
                        </td>
                    @endif
                    @foreach($renderable->columns() as $column)
                        <td>{!! $column->render(['row' => $row]) !!}</td>
                    @endforeach
                    @if(!empty($inline_buttons))
                        <td>
                            <x-admin::flex :items="$inline_buttons" gap="2" :params="['row'=>$row]"/>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if(method_exists($rows, 'hasPages') && !empty($rows->hasPages()))
        <div class="card-footer pb-0 border-top-0">
            {{$rows->links()}}
        </div>
    @endif
    @if(!empty($section_after_table))
        {!! render($section_after_table) !!}
    @endif
</div>

@pushonce('styles')
    <style>
        .table-crud td {
            vertical-align: middle;
        }

        .table-crud th {
            white-space: nowrap;
        }
    </style>
@endpushonce
@include('admin::crud.scripts.crud')
@include('admin::crud.scripts.table_scripts')
