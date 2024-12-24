(function () {
    "use strict";

    document.addEventListener("DOMContentLoaded", function () {
        var swiperConfig = {
            loop: true,
            speed: 600,
            autoplay: {
                delay: 5000,
            },
            slidesPerView: "auto",
            centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                type: "bullets",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        };

        var swiper = new Swiper(".init-swiper", swiperConfig);
    });

    function toggleScrolled() {
        const selectBody = document.querySelector("body");
        const selectHeader = document.querySelector("#header");
        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;
        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

    function mobileNavToogle(e) {
        e.stopPropagation();
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    }
    mobileNavToggleBtn.addEventListener("click", mobileNavToogle);

    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", (e) => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToogle(e);
            }
        });
    });

    document.querySelectorAll(".navmenu .toggle-dropdown").forEach((toggle) => {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();

            const parent = this.closest(".dropdown");
            parent.classList.toggle("dropdown-active");

            // Log untuk mengecek apakah dropdown menu muncul
            console.log(
                parent.classList.contains("dropdown-active")
                    ? "Dropdown opened"
                    : "Dropdown closed"
            );

            document.querySelectorAll(".navmenu .dropdown").forEach((other) => {
                if (other !== parent) {
                    other.classList.remove("dropdown-active");
                }
            });

            e.stopPropagation();
        });
    });

    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    let scrollTop = document.querySelector(".scroll-top");

    function toggleScrollTop() {
        if (scrollTop) {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        }
    }
    scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);

    function aosInit() {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }
    window.addEventListener("load", aosInit);

    function initSwiper() {
        document
            .querySelectorAll(".init-swiper")
            .forEach(function (swiperElement) {
                const configElement =
                    swiperElement.querySelector(".swiper-config");
                if (configElement) {
                    let config = JSON.parse(configElement.innerHTML.trim());

                    if (swiperElement.classList.contains("swiper-tab")) {
                        initSwiperWithCustomPagination(swiperElement, config);
                    } else {
                        new Swiper(swiperElement, config);
                    }
                } else {
                    console.warn(
                        "No .swiper-config element found in .init-swiper"
                    );
                }
            });
    }

    window.addEventListener("load", function () {
        initSwiper();

        $(document).ready(function () {
            $(".video-carousel").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true,
                        },
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        });
    });
})();
