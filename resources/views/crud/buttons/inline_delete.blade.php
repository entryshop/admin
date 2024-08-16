<a role="button" class="btn btn-xs btn-ghost-danger"
   data-confirm="@lang('admin::crud.delete_confirm')"
   data-action="{{$renderable->crud()->url($row->getKey())}}"
   data-method="delete">
    <i class="ri-delete-bin-line align-bottom"></i> @lang('admin::crud.delete')
</a>
