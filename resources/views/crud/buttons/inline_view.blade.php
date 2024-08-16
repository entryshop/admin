<a role="button" class="btn btn-xs btn-ghost-primary"
   href="{{$renderable->crud()->route()}}/{{$row->getKey()}}">
    <i class="ri-eye-line align-bottom"></i> {{$renderable->get('label', __('admin::crud.preview'))}}
</a>
