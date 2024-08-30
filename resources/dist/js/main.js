(function () {
    function initAjaxSetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    function initLayout() {

        // set sidebar size from session storage
        setDefaultAttribute('data-sidebar-size');

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

    function initActiveMenu() {
        // var currentPath = location.pathname == "/" ? "index" : location.pathname.substring(1);
        // currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
        var currentPath = location.pathname;
        if (currentPath) {
            // navbar-nav
            var a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');
            if (!a) {
                currentPath = location.href;
                a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');
            }

            if (!a) {
                currentPath = location.pathname;
                let links = $("#navbar-nav a").map(function (index, element) {
                    let _href = $(element).attr('href');
                    if (currentPath.indexOf(_href) > -1) {
                        return element;
                    }
                });
                a = links[0] || null;
            }

            if (a) {
                a.classList.add("active");
                var parentCollapseDiv = a.closest(".collapse.menu-dropdown");
                if (parentCollapseDiv) {
                    parentCollapseDiv.classList.add("show");
                    parentCollapseDiv.parentElement.children[0].classList.add("active");
                    parentCollapseDiv.parentElement.children[0].setAttribute("aria-expanded", "true");
                    if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
                        parentCollapseDiv.parentElement.closest(".collapse").classList.add("show");
                        if (parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling)
                            parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.classList.add("active");

                        if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) {
                            parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show");
                            if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) {

                                parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
                                if ((document.documentElement.getAttribute("data-layout") == "horizontal") && parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse")) {
                                    parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")
                                }
                            }
                        }
                    }
                }
            } else {
                console.log('can not set active menu:' + currentPath);
            }
        }
    }

    function _setAttribute(key, value) {
        sessionStorage.setItem(key, value);
        document.documentElement.setAttribute(key, value);
    }

    function setDefaultAttribute(key) {
        let value = sessionStorage.getItem("data-sidebar-size");
        if (value) {
            document.documentElement.setAttribute(key, value);
        }
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
        initActiveMenu();
    }

    init();
})();
