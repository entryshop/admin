@props([
    'items' => [],
    'params' => null,
])
<ul class="nav nav-tabs mb-3" role="tablist">
    @foreach($items as $_item)
        <li class="nav-item">
            <a class="nav-link {{$_item->active() ? 'active':''}}" data-bs-toggle="tab" href="#{{$_item->key()}}"
               role="tab" aria-selected="false">
                {{$_item->label()}}
            </a>
        </li>
    @endforeach
</ul>

<!-- Tab panes -->
<div class="tab-content  text-muted">
    @foreach($items as $item)
        <div class="tab-pane {{$item->active() ? 'active':''}}" id="{{$item->key()}}" role="tabpanel">
            {!! render($item, $params) !!}
        </div>
    @endforeach
</div>
