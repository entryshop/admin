@push('scripts')
    <script nonce="{{admin()->csp()}}">
        (function () {
            let linkages = @json($linkages);
            function hideRelatedFields() {
                for (let p in linkages) {
                    for (let i in linkages[p]) {
                        $("#field_" + linkages[p][i]).hide();
                        $("#" + linkages[p][i]).attr("disabled", "disabled")
                    }
                }
            }

            function valueChanged(value) {
                hideRelatedFields();
                if (linkages[value]) {
                    for (let i in linkages[value]) {
                        console.log(linkages[value][i]);
                        $("#" + linkages[value][i]).removeAttr("disabled")
                        $("#field_" + linkages[value][i]).show();
                    }
                }
            }

            $("input[name={{$name}}]").on('change', function () {
                valueChanged($(this).val());
            });

            hideRelatedFields();

            @if(!empty($value))
            valueChanged("{{$value}}");
            @endif
        })();
    </script>
@endpush
