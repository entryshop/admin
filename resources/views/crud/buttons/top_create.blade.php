<x-admin::buttons.action_button
    color="primary"
    icon="ri-add-line"
    href="{{$renderable->crud()->url('/create')}}"
    :label="__('admin::crud.create')"
/>
