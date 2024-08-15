@pushonce('scripts')
    <script nonce="{{admin()->csp()}}">
        $('[data-action]').on('click', function () {

            let dataParamAttributes = $(this).data();
            let action = dataParamAttributes.action;
            let method = dataParamAttributes.method ?? 'post';
            if (!action) {
                return;
            }

            if (dataParamAttributes.bulk) {
                // get selected ids
                let ids = getSelectedRows(dataParamAttributes.bulk);
                if (ids.length < 0) {
                    alert('Error');
                    return;
                }
                dataParamAttributes.ids = ids;
            }

            let confirm_title = $(this).data('confirm');
            if (confirm_title) {
                let confirm_text = $(this).data('confirm-text');
                Swal.fire({
                    title: confirm_title,
                    text: confirm_text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: $(this).data('confirm-ok') || "{{__('admin::crud.confirm_ok')}}",
                    cancelButtonText: $(this).data('confirm-cancel') || "{{__('admin::crud.confirm_cancel')}}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        runAction(action, method, dataParamAttributes);
                    }
                });
            } else {
                runAction(action, method, dataParamAttributes);
            }
        });

        function runAction(action, method, data) {
            $.ajax({
                url: action,
                method: method,
                data: data,
                success: function (response) {
                    runActionResponse(response);
                },
                error: function (error) {
                    let message = error.responseJSON.message || error.statusText;
                    Swal.fire({
                        title: 'Oops',
                        text: message,
                        icon: 'error',
                    })
                }
            });
        }
    </script>
@endpushonce
