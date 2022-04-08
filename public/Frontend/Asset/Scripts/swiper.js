var swiper = new Swiper(".swiper", {
    direction: "horizontal",
    centeredSlides: false,
    spaceBetween: 20,
    freeMode: true,
    breakpoints: {
        786: {
            slidesPerView: 4,
            slidesPerGroup: 2,
        },
    },
});
