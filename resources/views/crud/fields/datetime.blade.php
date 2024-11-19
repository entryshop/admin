@php
    $id = $id??$key;
    $value = old($name, $value??'');
@endphp
<x-admin::fields.field :$name :$id :label="$label??''">
    <input
        @if($time_only??false)
            data-provider="timepickr"
        @else
            data-provider="flatpickr" data-date-format="{{$format??'Y-m-d'}}"
        @if($has_time??false) data-enable-time="true" @endif
        @endif

        @if($has_seconds??false)
            data-enable-seconds="true"
        @endif

        @if($display_format??false)
            data-altFormat="{{$display_format}}"
        @endif

        class="form-control" value="{{$value}}" name="{{$name}}" id="{{$id}}">
</x-admin::fields.field>

@pushonce('scripts')
    <script nonce="{{admin()->csp()}}" src="{{admin()->asset('libs/flatpickr/flatpickr.min.js')}}"></script>
    @php
        $locale_map = [
            'zh_CN' => ['zh','zh'],
            'zh_TW' => ['zh-tw', 'zh_tw'],
            'vi' => ['vn', 'vn'],
        ];
        $locale = $locale_map[app()->getLocale()]??['default','default'];
    @endphp
    <script nonce="{{admin()->csp()}}" src="{{admin()->asset('libs/flatpickr/l10n/'.$locale[0].'.js')}}"></script>
    <script nonce="{{admin()->csp()}}">
        const flatpickrs = document.querySelectorAll("[data-provider]");
        Array.from(flatpickrs).forEach(function (item) {
            if (item.getAttribute("data-provider") === "flatpickr") {
                var dateData = {
                    locale: '{{$locale[1]}}'
                };
                var isFlatpickerVal = item.attributes;
                dateData.disableMobile = "true";
                if (isFlatpickerVal["data-date-format"]) {
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }

                if (isFlatpickerVal["data-enable-time"]) {
                    dateData.enableTime = true;
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString() + " H:i";
                }
                if (isFlatpickerVal["data-enable-seconds"]) {
                    dateData.enableTime = true;
                    dateData.enableSeconds = true;
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString() + " H:i:S";
                }
                if (isFlatpickerVal["data-altFormat"]) {
                    dateData.altInput = true;
                    dateData.altFormat = isFlatpickerVal["data-altFormat"].value.toString();
                }
                flatpickr(item, dateData);
            } else if (item.getAttribute("data-provider") === "timepickr") {
                var timeData = {
                    locale: '{{$locale[1]}}',
                    enableTime: true,
                    noCalendar: true,
                    time_24hr: true
                };
                var isTimepickerVal = item.attributes;
                if (isTimepickerVal["data-enable-seconds"]) {
                    timeData.dateFormat = "H:i:S"
                }
                flatpickr(item, timeData);
            }
        });
    </script>
@endpushonce
