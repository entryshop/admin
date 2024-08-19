<script nonce="{{admin()->csp()}}">
    (function () {
        class Admin {
            success = (message) => {
                this.toast({text: message, className: "success"})
            }

            error = (message) => {
                this.toast({text: message, className: "danger"})
            }

            warning = (message) => {
                this.toast({text: message, className: "warning"})
            }

            toast = (toastData) => {
                Toastify({
                    newWindow: true,
                    text: toastData.text,
                    // gravity: toastData.gravity,
                    // position: toastData.position,
                    className: "bg-" + toastData.className,
                    stopOnFocus: true,
                    escapeMarkup: false,
                    offset: {
                        x: toastData.offset ? 50 : 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: toastData.offset ? 10 : 0, // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                    duration: toastData.duration,
                    close: toastData.close == "close" ? true : false,
                    style: toastData.style == "style" ? {
                        background: "linear-gradient(to right, var(--vz-success), var(--vz-primary))"
                    } : "",
                }).showToast();
            }

            confirm = (data) => {
                Swal.fire({
                    title: data.confirm_title,
                    text: data.confirm_text,
                    icon: data.icon || "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: data.ok_label || "{{__('admin::crud.confirm_ok')}}",
                    cancelButtonText: data.cancel_label || "{{__('admin::crud.confirm_cancel')}}"
                }).then((result) => {
                    if (result.isConfirmed && data.callback) {
                        data.callback();
                    }
                });
            }

            runAction = (action, method, data) => {
                let that = this;
                $.ajax({
                    url: action,
                    method: method,
                    data: data,
                    success: function (response) {
                        that.actionResponse(response);
                    },
                    error: function (error) {
                        let message = error.responseJSON.message || error.statusText;
                        window.admin.error(message);
                    }
                });
            }

            actionResponse = (response) => {
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
            };
        }

        window.admin = new Admin();
    })();
</script>
