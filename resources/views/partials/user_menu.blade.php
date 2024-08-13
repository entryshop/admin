<div class="dropdown-menu dropdown-menu-end">
    @foreach($menus as $menu)
        <a class="dropdown-item" href="{{$menu->url()}}" target="{{$menu->get('target', '_self')}}">
            <i class="{{$menu->icon()}} text-muted fs-16 align-middle me-1"></i>
            <span class="align-middle">{{$menu->label()}}</span>
        </a>
    @endforeach
</div>
