<x-admin::buttons.action_button
    :data-confirm="__('admin::crud.delete_confirm')"
    :data-action="$renderable->crud()->url('batch-delete')"
    :data-bulk="$renderable->crud()->name()"
    color="danger"
    icon="ri-delete-bin-line"
    :label="__('admin::crud.delete')"
/>
