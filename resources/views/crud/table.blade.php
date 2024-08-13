@php
    $top_buttons = $renderable->buttons('top');
    $inline_buttons = $renderable->buttons('inline');
    $bulk_buttons = $renderable->buttons('bulk');
    $filters = $renderable->filters();
    $rows = $renderable->entries();

    if(method_exists($rows, 'paginate')) {
        $rows = $rows->paginate(10);
    }
@endphp

<div class="card">
    @if(!empty($top_buttons) || !empty($bulk_buttons) || !empty($filters))
        <div class="card-header">
            <div data-filters class="d-flex justify-content-between align-items-center">
                @if(!empty($filters))
                    <form class="d-flex flex-wrap gap-1">
                        @foreach($renderable->filters() as $filter)
                            <div>
                                {!! $filter->render() !!}
                            </div>
                        @endforeach
                        <div>
                            <button class="btn btn-primary"><i class="ri-search-2-line"></i></button>
                        </div>
                    </form>
                @endif
                @if(!empty($top_buttons))
                    @include('admin::crud.inc.buttons', ['buttons' => $top_buttons])
                @endif
            </div>
            @if(!empty($bulk_buttons))
                <div data-bulks class="d-none">
                    @include('admin::crud.inc.buttons', ['buttons' => $bulk_buttons])
                </div>
            @endif
        </div>
    @endif
    <table class="table mb-0 table-hover" id="{{$name}}">
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
            <tr>
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
                        @include('admin::crud.inc.buttons', ['buttons' => $inline_buttons])
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(method_exists($rows, 'links'))
        <div class="card-footer pb-0">
            {{$rows->links()}}
        </div>
    @endif
</div>

@include('admin::crud.scripts.crud')
@include('admin::crud.scripts.table_scripts')
