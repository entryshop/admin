$('.check-select-all').on('change', function () {
    $('.row-chkbox').prop('checked', $(this).prop('checked'));
    checkUpdated();
});

$('.cancel-selected').on('click', function () {
    $('.check-select-all').prop('checked', false);
    $('.row-chkbox').prop('checked', false);
    checkUpdated();
});

$('.row-chkbox').on('change', function () {
    checkUpdated();
});

function checkUpdated() {
    let checked = $('.row-chkbox:checked').length;
    if (checked > 0) {
        $('.batch-actions').addClass('d-block');
        $('.table-tools').addClass('d-none');
        $('.batch-actions').removeClass('d-none');
        $('.table-tools').removeClass('d-block');

        $('.total_checked').html(checked);
    } else {
        $('.batch-actions').removeClass('d-block');
        $('.table-tools').removeClass('d-none');
        $('.batch-actions').addClass('d-none');
        $('.table-tools').addClass('d-block');
    }
}

function getCheckedRowIds() {
    let ids = [];
    $('.row-chkbox:checked').each(function () {
        ids.push($(this).data('id'));
    });
    return ids;
}

$('.batch-action').on('click', function () {
    const confirm_message = $(this).data('confirm');
    if (confirm_message) {
        if (!confirm(confirm_message)) {
            return;
        }
    }

    const action = $(this).data('action');

    if (!action) {
        return;
    }

    $.ajax({
        url: $(this).data('action'), method: $(this).data('method') || 'post', data: {
            ids: getCheckedRowIds()
        }, success: function (response) {
            const message = response.message;
            if (message) {
                Toastify({
                    text: message, duration: 3000, close: true,
                }).showToast();
            }

            switch (response.action) {
                case 'refresh':
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                    break;
                case 'redirect':
                    setTimeout(function () {
                        window.location.href = response.url;
                    }, 3000);
                    break;
            }
        }
    })
});
