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
    @foreach($items as $_item)
        <div class="tab-pane {{$_item->active() ? 'active':''}}" id="{{$_item->key()}}" role="tabpanel">
            {!! render($_item, $params) !!}
        </div>
    @endforeach
</div>
