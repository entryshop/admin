<a role="button" class="btn btn-xs btn-ghost-primary"
   href="{{$renderable->crud()->url($row->getKey().'/edit')}}"
   target="{{$renderable->get('target', '_self')}}">
    <i class="ri-edit-line align-bottom"></i> {{$renderable->get('label', __('admin::crud.edit'))}}
</a>
