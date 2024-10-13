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
                $("#field_" + _id).addClass('linkage-hidden');
                $("#field_" + _id).find("input").each(function () {
                    $(this).attr("disabled", "disabled")
                });
            }

            function showField(_id) {
                $("#field_" + _id).removeClass('linkage-hidden');
                $("#field_" + _id).find("input").each(function () {
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
