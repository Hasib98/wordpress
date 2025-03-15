document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".offer_cards_container", {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: ".right",
            prevEl: ".left",
        },
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
});
