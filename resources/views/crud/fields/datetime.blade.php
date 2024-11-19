@php
    $id = $id??$key;
@endphp
<x-admin::fields.field :$name :$id :label="$label??''">
    <input
        @if($time_only??false)
            data-provider="timepickr"
        @else
            data-provider="flatpickr" data-date-format="Y-m-d"
            @if($has_time??false)
                data-enable-time="true"
            @endif
        @endif

        @if($has_seconds??true)
            data-enable-seconds="true"
        @endif

        class="form-control" value="{{$value}}" name="{{$name}}" id="{{$id}}">
</x-admin::fields.field>

@pushonce('scripts')
    <script src="{{admin()->asset('libs/flatpickr/flatpickr.min.js')}}"></script>
    @php
        $locale_map = [
            'zh_CN' => ['zh','zh'],
            'zh_TW' => ['zh-tw', 'zh_tw'],
            'vi' => ['vn', 'vn'],
        ];
        $locale = $locale_map[app()->getLocale()]??['default','default'];
    @endphp
    <script src="{{admin()->asset('libs/flatpickr/l10n/'.$locale[0].'.js')}}"></script>
    <script nonce="{{admin()->csp()}}">
        const flatpickrs = document.querySelectorAll("[data-provider]");
        Array.from(flatpickrs).forEach(function (item) {
            if (item.getAttribute("data-provider") === "flatpickr") {
                var dateData = {
                    locale: '{{$locale[1]}}'
                };
                var isFlatpickerVal = item.attributes;
                dateData.disableMobile = "true";
                if (isFlatpickerVal["data-date-format"])
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
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
                    (dateData.altInput = true),
                        (dateData.altFormat = isFlatpickerVal["data-altFormat"].value.toString());
                }
                if (isFlatpickerVal["data-minDate"]) {
                    dateData.minDate = isFlatpickerVal["data-minDate"].value.toString();
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-maxDate"]) {
                    dateData.maxDate = isFlatpickerVal["data-maxDate"].value.toString();
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-default-date"]) {
                    dateData.defaultDate = isFlatpickerVal["data-default-date"].value.toString();
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-multiple-date"]) {
                    dateData.mode = "multiple";
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-range-date"]) {
                    dateData.mode = "range";
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-inline-date"]) {
                    (dateData.inline = true),
                        (dateData.defaultDate = isFlatpickerVal["data-default-date"].value.toString());
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-disable-date"]) {
                    var dates = [];
                    dates.push(isFlatpickerVal["data-disable-date"].value);
                    dateData.disable = dates.toString().split(",");
                }
                if (isFlatpickerVal["data-week-number"]) {
                    var dates = [];
                    dates.push(isFlatpickerVal["data-week-number"].value);
                    dateData.weekNumbers = true
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
                console.log(timeData);
                flatpickr(item, timeData);
            }
        });
    </script>
@endpushonce
