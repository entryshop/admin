@once
    @push('scripts')
        <script nonce="{{admin()->csp()}}">
            let linkages = @json($linkages);

            function hideRelatedFields() {
                for (let p in linkages) {
                    for (let i in linkages[p]) {
                        $("#field_" + linkages[p][i]).addClass('linkage-hidden');
                        $("#" + linkages[p][i]).attr("disabled", "disabled")
                    }
                }
            }

            function valueChanged(value) {
                hideRelatedFields();
                if (linkages[value]) {
                    for (let i in linkages[value]) {
                        $("#" + linkages[value][i]).removeAttr("disabled")
                        $("#field_" + linkages[value][i]).removeClass('linkage-hidden');
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
