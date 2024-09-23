@php
    switch ($color??'primary') {
        case 'danger':
            $color_icon_bg = 'bg-danger-subtle';
            $color_icon_text = 'text-danger';
            break;
        default:
            $color_icon_bg = 'bg-primary-subtle';
            $color_icon_text = 'text-primary';
            break;
    }
@endphp

<div class="card card-animate">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1">
                <p class="fw-medium text-muted mb-0">{!! $title !!}</p>
            </div>
            @if(!empty($right))
                <div class="flex-shrink-0">
                    {!! render($right) !!}
                </div>
            @endif
        </div>
        <div class="d-flex align-items-end justify-content-between mt-4">
            <div>
                @if(!empty($value))
                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                        {!! render($value) !!}
                    </h4>
                @endif
                @if(!empty($link))
                    <a href="{{$link}}" class="text-decoration-underline">{{$linkText??''}}</a>
                @endif
            </div>
            @if(!empty($icon))
                <div class="avatar-sm flex-shrink-0">
                    <span class="avatar-title {{$color_icon_bg}} rounded fs-3 material-shadow">
                        <i class="{{$icon}} {{$color_icon_text}}"></i>
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
