@pushonce('scripts')
    <script nonce="{{admin()->csp()}}">
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
                        form.trigger('reset');
                        if (modal) {
                            modal.modal('hide');
                        }
                        window.admin.actionResponse(response);
                    }
                })
            });
        });
    </script>
    @include('admin::crud.scripts.action_scripts')
@endpushonce
