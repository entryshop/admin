@pushonce('scripts')
    <script nonce="{{admin()->csp()}}">
        function runActionResponse(response) {
            let action = response.action;
            switch (action) {
                case 'redirect':
                    window.location.href = response.url;
                    break;
                case 'reload':
                case 'refresh':
                    window.location.reload();
                    break;
                case 'message':
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.type
                    })
                    break;
            }
        }

        $(function () {
            $('[data-ajax-submit]').on('click', function () {
                // ajax submit form
                let form = $(this).closest('form');
                let modal = $(this).closest('.modal');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        // reset form
                        form.trigger('reset');

                        if (modal) {
                            modal.modal('hide');
                        }

                        runActionResponse(response);
                    }
                })
            });
        });
    </script>
    @include('admin::crud.scripts.action_scripts')
@endpushonce
