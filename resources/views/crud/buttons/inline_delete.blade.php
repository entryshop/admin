<a role="button" class="text-danger"
   data-confirm="@lang('admin::crud.delete_confirm')"
   data-action="{{$renderable->crud()->url($row->getKey())}}"
   data-method="delete">
    <i class="ri-delete-bin-line"></i> @lang('admin::crud.delete')
</a>
