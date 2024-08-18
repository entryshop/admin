@php
    $_data = array_merge(['user'=> auth()->user()],$renderable->getContext());
    foreach (['href', 'action', 'label', 'confirm'] as $item) {
        $$item = interpolate($$item??null, $_data);
    }
@endphp

<x-admin::buttons.action_button
    :color="$color ?? 'primary'"
    :icon="$icon??null"
    :size="$size??null"
    :data-method="$method??null"
    :data-confirm="$confirm??null"
    :data-action="$action??null"
    :label="$label??null"
    :href="$href??null"
    :target="$target??null"
/>
