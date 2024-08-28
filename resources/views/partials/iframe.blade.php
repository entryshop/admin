<div id="iframeModal" class="modal fade" tabindex="-1" aria-labelledby="iframeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="iframe" class="w-100 h-100"></iframe>
            </div>
        </div>
    </div>
</div>

<script nonce="{{admin()->csp()}}">
    $('[data-iframe]').on('click', function () {

        let iframe_url = $(this).data('iframe');
        if ($(this).data('bulk')) {
            let selected = getSelectedRows();
            iframe_url += '&ids=' + selected.join(',');
        }
        $('#iframeModal #iframe').attr('src', iframe_url);
        $('#iframeModal').modal('show');
        if ($(this).data('height')) {
            $('#iframeModal .modal-body').height($(this).data('height'));
        }
        if ($(this).data('title')) {
            $('#iframeModal .modal-title').text($(this).data('title'));
        }
    });
</script>
