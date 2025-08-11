import "./bootstrap";
import Swiper from "swiper";
import { Autoplay } from "swiper/modules";
import "swiper/css";

function initReviewsSwiper() {
    const el = document.querySelector(".reviews-swiper");
    if (!el) return;

    if (el._swiperInstance) {
        el._swiperInstance.destroy(true, true);
        el._swiperInstance = null;
    }

    const instance = new Swiper(".reviews-swiper", {
        modules: [Autoplay],
        slidesPerView: 1.5,
        spaceBetween: 20,
        loop: true,
        // autoHeight: false,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            reverseDirection: true,
        },
        breakpoints: {
            640: { slidesPerView: 2.5 },
            1024: { slidesPerView: 4 },
        },
    });

    el._swiperInstance = instance;
}

document.addEventListener("DOMContentLoaded", initReviewsSwiper);
document.addEventListener("livewire:load", initReviewsSwiper);
document.addEventListener("livewire:navigated", initReviewsSwiper);
