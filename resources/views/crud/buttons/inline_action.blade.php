@php
    if(!empty($row)) {
        $_data = ['row' => $row, 'user' => auth()->user()];
        $href = interpolate($href??null, $_data);
        $action = interpolate($action??null, $_data);
    }
@endphp

<x-admin::buttons.action_button
    :size="$size??'xs'"
    :color="$color??'ghost-primary'"
    :icon="$icon??null"
    :data-method="$method??null"
    :data-confirm="$confirm??null"
    :data-action="$action??null"
    :label="$label??null"
    :href="$href??null"
    :target="$target??null"
/>
