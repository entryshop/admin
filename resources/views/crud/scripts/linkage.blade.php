@once
    @push('scripts')
        <script nonce="{{admin()->csp()}}">
            let linkages = @json($linkages);

            function hideRelatedFields() {
                for (let p in linkages) {
                    for (let i in linkages[p]) {
                        let _id = linkages[p][i];
                        hideField(_id);
                    }
                }
            }

            function hideField(_id) {
                let _field = $("#field_" + _id);
                _field.addClass('linkage-hidden');
                _field.find("input").each(function () {
                    $(this).attr("disabled", "disabled")
                });
            }

            function showField(_id) {
                let _field = $("#field_" + _id);
                _field.removeClass('linkage-hidden');
                _field.find("input").each(function () {
                    $(this).removeAttr("disabled");
                });
            }

            function valueChanged(value) {
                hideRelatedFields();
                if (linkages[value]) {
                    for (let i in linkages[value]) {
                        let _id = linkages[value][i];
                        showField(_id);
                    }
                }
            }

            hideRelatedFields();
        </script>
    @endpush
    @push('styles')
        <style nonce="{{admin()->csp()}}">
            .linkage-hidden {
                display: none;
            }
        </style>
    @endpush
@endonce
