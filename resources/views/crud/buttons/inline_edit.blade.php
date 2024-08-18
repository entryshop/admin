<x-admin::buttons.action_button
    size="xs"
    color="ghost-primary"
    icon="ri-edit-line"
    href="{{$renderable->crud()->url($entity->getKey().'/edit')}}"
    :label="__('admin::crud.edit')"
/>
