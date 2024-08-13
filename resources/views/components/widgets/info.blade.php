@props([
    'title' => '',
    'value' => '',
    'link' => null,
    'color' => 'default',
    'icon' => null,
])

@php
    $bg_color = '';
    $value_color = '';
    $title_color= '';
    $link_color = '';
    $icon_class = '';
    switch ($color) {
        case 'primary':
            $bg_color = 'bg-primary';
            $value_color = 'text-white';
            $title_color = 'text-white-50';
            $link_color = 'text-white-50';
            $icon_class = 'bg-white text-primary';
            break;
        case 'info':
            $bg_color = 'bg-info';
            $value_color = 'text-white';
            $title_color = 'text-white-50';
            $link_color = 'text-white-50';
            $icon_class = 'bg-white text-warning';
            break;
        case 'success':
            $bg_color = 'bg-success';
            $value_color = 'text-white';
            $title_color = 'text-white-50';
            $link_color = 'text-white-50';
            $icon_class = 'bg-success-subtle text-success';
            break;
        case 'danger':
            $bg_color = 'bg-danger';
            $value_color = 'text-white';
            $title_color = 'text-white-50';
            $link_color = 'text-white-50';
            $icon_class = 'bg-danger-subtle text-danger';
            break;
        case 'warning':
            $bg_color = 'bg-warning';
            $value_color = 'text-white';
            $title_color = 'text-white-50';
            $link_color = 'text-white-50';
            $icon_class = 'bg-warning-subtle text-warning';
            break;
        default:
            break;
    }
@endphp

<div class="card card-animate {{$bg_color}}">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <p class="fw-medium text-muted mb-0 {{$title_color}}">{{$title}}</p>
                <h2 class="mt-4 ff-secondary fw-semibold {{$value_color}}">{{$value}}</h2>
            </div>
            @if($icon)
                <div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title {{$icon_class}} rounded-circle fs-4">
                            <i class="{{$icon}}"></i>
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
