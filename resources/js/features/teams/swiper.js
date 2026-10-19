import Swiper from 'swiper';
import { A11y, Autoplay, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

export function initTeamSwipers() {
    const roots = document.querySelectorAll('[data-team-swiper]');

    if (!roots.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    roots.forEach((root) => {
        const swiperEl = root.querySelector('.swiper');

        if (!swiperEl) {
            return;
        }

        const slideCount = root.querySelectorAll('.swiper-slide').length;

        new Swiper(swiperEl, {
            modules: [A11y, Autoplay, Navigation, Pagination],
            slidesPerView: 1.15,
            spaceBetween: 20,
            grabCursor: true,
            loop: slideCount > 4,
            speed: 600,
            autoplay: prefersReducedMotion
                ? false
                : { delay: 3500, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: {
                el: root.querySelector('[data-team-pagination]'),
                clickable: true,
            },
            navigation: {
                prevEl: root.querySelector('[data-team-prev]'),
                nextEl: root.querySelector('[data-team-next]'),
            },
            breakpoints: {
                640: { slidesPerView: 2.2, spaceBetween: 24 },
                1024: { slidesPerView: 3.2, spaceBetween: 28 },
                1280: { slidesPerView: 4, spaceBetween: 28 },
            },
        });
    });
}
