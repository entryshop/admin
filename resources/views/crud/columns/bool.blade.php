@php
    $yes_color ??= 'success';
    $no_color ??= 'muted';
    switch ($style??null){
        case 'switch':
            $yes_icon = 'ri-toggle-fill';
            $no_icon = 'ri-toggle-line';
            break;
        case 'bool':
            $yes_icon = 'ri-check-line';
            $no_icon = 'ri-close-line';
            break;
        case 'check':
            $yes_icon = 'ri-checkbox-circle-fill';
            $no_icon = 'ri-close-circle-line';
            break;
        case 'checkbox':
            $yes_icon = 'ri-checkbox-fill';
            $no_icon = 'ri-checkbox-blank-line';
            break;
            default:
                $yes_icon =  null;
                $no_icon = null;
    }
@endphp

@if($value ?? false)
    @if($yes_icon)
        <i class="{{$yes_icon}} text-{{$yes_color}} align-bottom"></i>
    @else
        <span class="text-{{$yes_color}}">{!! $yes_text ?? 'Y'  !!}</span>
    @endif
@else
    @if($no_icon)
        <i class="{{$no_icon}} text-{{$no_color}} align-bottom"></i>
    @else
        <span class="text-{{$no_color}}">{!! $no_text ?? 'N'  !!}</span>
    @endif
@endif
