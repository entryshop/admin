<button class="btn btn-danger"
        data-confirm="@lang('admin::crud.delete_confirm')"
        data-action="{{$renderable->crud()->url('batch-delete')}}"
        data-bulk="{{$renderable->crud()->name()}}">
    <i class="ri-delete-bin-line"></i> {{$label ?? __('admin::crud.delete')}}
</button>
