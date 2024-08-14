<ul class="navbar-nav" id="navbar-nav">
    @foreach($menus as $menu)
        @if(empty($menu->children()))
            @if($menu->get('type') == 'divider')
                <li class="menu-title">
                    <span data-key="t-menu">{{$menu->get('label')}}</span>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{$menu->get('url')}}" class="nav-link menu-link"
                       target="{{$menu->get('target', '_self')}}">
                        <i class="{{$menu->get('icon')}}"></i>
                        <span>{{$menu->get('label')}}</span>
                    </a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebar{{$loop->index}}"
                   data-bs-toggle="collapse"
                   role="button"
                   aria-expanded="false" aria-controls="sidebarAuth">
                    <i class="{{$menu->get('icon')}}"></i>
                    <span>{{$menu->get('label')}}</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebar{{$loop->index}}">
                    <ul class="nav nav-sm flex-column">
                        @foreach($menu->children() as $child)
                            <li class="nav-item {{$child->active() ? 'active' : ''}}">
                                <a href="{{$child->get('url')}}" target="{{$child->get('target', '_self')}}"
                                   class="nav-link">{{$child->get('label')}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
    @endforeach
</ul>
