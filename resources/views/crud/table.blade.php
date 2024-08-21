@php
    use Entryshop\Admin\Crud\CrudPanel;
    $top_buttons = $renderable->buttons('top');
    $inline_buttons = $renderable->buttons('inline');
    $bulk_buttons = $renderable->buttons('bulk');
    $section_before_table = $renderable->children(CrudPanel::CHILD_POSITION_BEFORE_TABLE);
    $section_after_table = $renderable->children(CrudPanel::CHILD_POSITION_AFTER_TABLE);
    $section_before_header = $renderable->children('before_header');
    $filters = $renderable->filters();
    $entities = $renderable->entities();

    if(method_exists($entities, 'paginate')) {
        $entities = $entities->paginate(10);
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
            <thead class="table-light">
            @if(count($bulk_buttons))
                <th class="w-34px">
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
            @foreach($entities as $entity)
                <tr {!! interpolate($renderable->get('row_attrs'), ['entity'=>$entity]) !!} data-id="{{$entity->getKey()}}">
                    @if(count($bulk_buttons))
                        <td>
                            <div class="form-check">
                                <input class="form-check-input row-select" type="checkbox"
                                       data-id="{{$entity->getKey()}}">
                            </div>
                        </td>
                    @endif
                    @foreach($renderable->columns() as $column)
                        <td>
                            {!! render($column, ['entity' => $entity]) !!}
                        </td>
                    @endforeach
                    @if(!empty($inline_buttons))
                        <td class="inline-buttons">
                            <x-admin::flex :wrap="false" :items="$inline_buttons" gap="2"
                                           :params="['entity'=>$entity]"/>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if(method_exists($entities, 'hasPages') && !empty($entities->hasPages()))
        <div class="card-footer pb-0 border-top-0">
            {{$entities->links()}}
        </div>
    @endif
    @if(!empty($section_after_table))
        {!! render($section_after_table) !!}
    @endif
</div>

@pushonce('styles')
    <style nonce="{{admin()->csp()}}">
        .table-crud td {
            vertical-align: middle;
        }

        .table-crud th {
            white-space: nowrap;
        }

        .table-crud tr[data-action] {
            cursor: pointer;
        }

        .table-crud td.inline-buttons {
            white-space: nowrap;
        }
    </style>
@endpushonce

@include('admin::crud.scripts.crud')
@include('admin::crud.scripts.table_scripts')
