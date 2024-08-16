<x-admin::buttons.action_button
    size="xs"
    color="ghost-primary"
    icon="ri-eye-line"
    href="{{$renderable->crud()->url($row->getKey())}}"
    :label="__('admin::crud.preview')"
/>
