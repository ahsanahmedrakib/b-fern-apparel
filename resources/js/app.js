import { initContactValidation } from './features/contact/validation';
import { initTeamSwipers } from './features/teams/swiper';
import { initTeamModals } from './features/admin/team-modals';

function initMobileNav() {
    const toggle = document.getElementById('mobile-nav-toggle');
    const panel = document.getElementById('mobile-nav-panel');

    if (!toggle || !panel) {
        return;
    }

    const setOpen = (open) => {
        panel.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    };

    toggle.addEventListener('click', () => {
        setOpen(panel.classList.contains('hidden'));
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            setOpen(false);
        }
    });
}

function initHeaderShadow() {
    const header = document.getElementById('site-header');

    if (!header) {
        return;
    }

    const update = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 8);
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
}

function initReveal() {
    const elements = Array.from(document.querySelectorAll('[data-reveal]'));

    if (!elements.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-visible'));

        return;
    }

    const groups = new Map();

    elements.forEach((element) => {
        const parent = element.parentElement;

        if (!parent) {
            return;
        }

        if (!groups.has(parent)) {
            groups.set(parent, []);
        }

        groups.get(parent).push(element);
    });

    groups.forEach((children) => {
        if (children.length < 2) {
            return;
        }

        children.forEach((element, index) => {
            element.style.setProperty('--reveal-delay', `${Math.min(index * 70, 420)}ms`);
        });
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                entry.target.classList.toggle('is-visible', entry.isIntersecting);
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
    );

    elements.forEach((element) => observer.observe(element));
}

document.addEventListener('DOMContentLoaded', () => {
    initMobileNav();
    initHeaderShadow();
    initReveal();
    initTeamSwipers();
    initTeamModals();
    initContactValidation();
});
