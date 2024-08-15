<a class="badge bg-primary-subtle text-primary"
   href="{{$renderable->crud()->route()}}/{{$row->getKey()}}">
    <i class="ri-eye-2-line"></i> {{$renderable->get('label', __('admin::crud.preview'))}}
</a>
