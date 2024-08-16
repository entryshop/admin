(function () {
    function initAjaxSetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    function initLayout() {
        if (document.getElementById("topnav-hamburger-icon")) {
            document.getElementById("topnav-hamburger-icon").addEventListener("click", _toggleHamburgerMenu);
        }

        const verticalOverlay = document.getElementsByClassName("vertical-overlay");
        if (verticalOverlay) {
            Array.from(verticalOverlay).forEach(function (element) {
                element.addEventListener("click", function () {
                    document.body.classList.remove("vertical-sidebar-enable");
                    document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size"));
                });
            });
        }
    }

    function _setAttribute(key, value) {
        sessionStorage.setItem(key, value);
        document.documentElement.setAttribute(key, value);
    }

    function _toggleHamburgerMenu() {
        const windowSize = document.documentElement.clientWidth;

        if (windowSize > 767)
            document.querySelector(".hamburger-icon").classList.toggle("open");

        //For collapse horizontal menu
        if (document.documentElement.getAttribute("data-layout") === "horizontal") {
            document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu");
        }

        //For collapse vertical menu
        if (document.documentElement.getAttribute("data-layout") === "vertical") {
            if (windowSize <= 1025 && windowSize > 767) {
                document.body.classList.remove("vertical-sidebar-enable");
                document.documentElement.getAttribute("data-sidebar-size") === "sm" ?
                    _setAttribute("data-sidebar-size", "") :
                    _setAttribute("data-sidebar-size", "sm");
            } else if (windowSize > 1025) {
                document.body.classList.remove("vertical-sidebar-enable");
                document.documentElement.getAttribute("data-sidebar-size") === "lg" ?
                    _setAttribute("data-sidebar-size", "sm") :
                    _setAttribute("data-sidebar-size", "lg");
            } else if (windowSize <= 767) {
                document.body.classList.add("vertical-sidebar-enable");
                _setAttribute("data-sidebar-size", "lg");
            }
        }
    }

    function init() {
        initAjaxSetup();
        initLayout();
    }

    init();
})();
