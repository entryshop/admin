@pushonce('after_scripts')
    <script nonce="{{admin()->csp()}}">
        $('.row-select').on('change', function () {
            updateRowSelect();
        });

        $('.row-select-all').on('change', function () {
            $('.row-select').prop('checked', $(this).prop('checked'));
            updateRowSelect();
        });

        $('.bulk-buttons button').on('click', function () {
            let action = $(this).data('action');
            if (!action) {
                return;
            }

            let confirm_message = $(this).data('confirm');
            if (confirm_message) {
                if (!confirm(confirm_message)) {
                    return;
                }
            }

            $.ajax({
                url: action,
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    ids: getSelectedRows()
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });

        function getSelectedRows(crud_name) {
            let selector = '.row-select:checked';
            if (crud_name) {
                selector = '#' + crud_name + ' ' + selector;
            }
            return $(selector).map(function () {
                return $(this).data('id');
            }).get();
        }

        /**
         * show bulk buttons when selected rows > 0
         */
        function updateRowSelect() {
            let selected = getSelectedRows();
            if (selected.length > 0) {
                $('[data-filters]').addClass('d-none');
                $('[data-bulks]').removeClass('d-none');
            } else {
                $('[data-bulks]').addClass('d-none');
                $('[data-filters]').removeClass('d-none');
            }
        }
    </script>
@endpushonce
