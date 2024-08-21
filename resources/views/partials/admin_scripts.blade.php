<script nonce="{{admin()->csp()}}">
    (function () {
        class Admin {

            session = () => {
                return '{{request()->session()->getId()}}';
            }

            success = (message) => {
                this.toast({text: message, className: "success"})
            }

            error = (message) => {
                this.toast({text: message, className: "danger"})
            }

            warning = (message) => {
                this.toast({text: message, className: "warning"})
            }

            isIframe = () => {
                if (self.frameElement && self.frameElement.tagName === "IFRAME") {
                    return true;
                }

                if (window.frames.length !== parent.frames.length) {
                    return true;
                }

                if (self !== top) {
                    return true;
                }

                return false;
            }

            closeIframeModal = () => {
                $('#iframeModal').modal('hide');
            }

            refresh = () => {
                window.location.reload();
            }

            redirect = (url) => {
                window.location.href = url;
            }

            toast = (toastData) => {
                Toastify({
                    newWindow: true,
                    text: toastData.text,
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

            alert = (alert) => {
                Swal.fire(alert)
            }

            actionResponse = (action) => {
                if (action.delay) {
                    setTimeout(() => {
                        this._runAction(action);
                    }, action.delay);
                } else {
                    this._runAction(action);
                }
            };

            _runAction = (data) => {
                let action = data.action;
                switch (action) {
                    case 'redirect':
                        this.redirect(data.url);
                        break;
                    case 'reload':
                    case 'refresh':
                        this.refresh();
                        break;
                    case 'alert':
                        this.alert(data);
                        break;
                    case 'message':
                        this.toast(data);
                        break;
                }
            }
        }

        window.admin = new Admin();
    })();
</script>
