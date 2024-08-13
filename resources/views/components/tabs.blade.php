<ul class="nav nav-tabs mb-3" role="tablist">
    @foreach($renderable->children() as $child)
        <li class="nav-item">
            <a class="nav-link {{$child->active() ? 'active':''}}" data-bs-toggle="tab" href="#{{$child->key()}}"
               role="tab" aria-selected="false">
                {{$child->label()}}
            </a>
        </li>
    @endforeach
</ul>
<!-- Tab panes -->
<div class="tab-content  text-muted">
    @foreach($renderable->children() as $child)
        <div class="tab-pane {{$child->active() ? 'active':''}}" id="{{$child->key()}}" role="tabpanel">
            {!! render($child) !!}
        </div>
    @endforeach
</div>
