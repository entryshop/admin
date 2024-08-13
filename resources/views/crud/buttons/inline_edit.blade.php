<a href="{{$renderable->crud()->url($row->getKey().'/edit')}}" target="{{$renderable->get('target', '_self')}}">
    <i class="ri-edit-line"></i> {{$renderable->get('label', __('admin::crud.edit'))}}
</a>
