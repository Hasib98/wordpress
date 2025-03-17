/* document.addEventListener("DOMContentLoaded", function () {
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
 */

document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".mySwiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-btn-next",
            prevEl: ".swiper-btn-prev",
        },
    });
});
document.addEventListener("DOMContentLoaded", function () {
     new Swiper(".xxxxx", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
});



