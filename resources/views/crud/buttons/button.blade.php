@php
    $_data = array_merge(['user'=> auth()->user()],$renderable->getContext());
    foreach (['href', 'action', 'label', 'confirm', 'iframe'] as $item) {

        $string = $$item??null;
        if(empty($string)) {
            continue;
        }

        $string = \Illuminate\Support\Str::replace("%7B", "{", $string);
        $string = \Illuminate\Support\Str::replace("%7D", "}", $string);

        $$item = interpolate($string, $_data);
    }

    $data = [
        'data-method'  => $method??null,
        'data-iframe'  => $iframe??null,
        'data-confirm' => $confirm??null,
        'data-action'  => $action??null,
    ];
    foreach ($__data as $key => $value) {
        if(\Illuminate\Support\Str::startsWith($key, 'data-')) {
            $data[$key] = interpolate($value, $_data);
        }
    }

    $id  ??= $key;
    $name  ??= $key;
    $icon ??= null;
    $color ??= null;
    $size ??= null;
    $href ??= null;
    $target ??= null;
@endphp

<x-admin::buttons.action_button
    :$name
    :$label
    :$href
    :$target
    :$size
    :$icon
    :$color
    :$id
    :$label
    :$data
/>

