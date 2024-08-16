<div class="ms-1 header-item d-none d-sm-flex">
    <button type="button"
            class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
            data-toggle="fullscreen">
        <i class='bx bx-fullscreen fs-22'></i>
    </button>
</div>

@pushonce('scripts')
    <script nonce="{{admin()->csp()}}">
        (function () {
            function initFullScreen() {
                const fullscreenBtn = document.querySelector('[data-toggle="fullscreen"]');
                fullscreenBtn &&
                fullscreenBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    document.body.classList.toggle("fullscreen-enable");
                    if (!document.fullscreenElement &&
                        /* alternative standard method */
                        !document.mozFullScreenElement &&
                        !document.webkitFullscreenElement
                    ) {
                        // current working methods
                        if (document.documentElement.requestFullscreen) {
                            document.documentElement.requestFullscreen();
                        } else if (document.documentElement.mozRequestFullScreen) {
                            document.documentElement.mozRequestFullScreen();
                        } else if (document.documentElement.webkitRequestFullscreen) {
                            document.documentElement.webkitRequestFullscreen(
                                Element.ALLOW_KEYBOARD_INPUT
                            );
                        }
                    } else {
                        if (document.cancelFullScreen) {
                            document.cancelFullScreen();
                        } else if (document.mozCancelFullScreen) {
                            document.mozCancelFullScreen();
                        } else if (document.webkitCancelFullScreen) {
                            document.webkitCancelFullScreen();
                        }
                    }
                });

                document.addEventListener("fullscreenchange", exitHandler);
                document.addEventListener("webkitfullscreenchange", exitHandler);
                document.addEventListener("mozfullscreenchange", exitHandler);

                function exitHandler() {
                    if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                        document.body.classList.remove("fullscreen-enable");
                    }
                }
            }
            initFullScreen();
        })();
    </script>
@endpushonce
