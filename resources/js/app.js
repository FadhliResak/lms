import './bootstrap';
import 'bootstrap';
import { Tooltip } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new Tooltip(el));

    const nav = document.querySelector('.navbar.fixed-top');
    const setNavH = () => {
        if (nav) {
            const h = nav.offsetHeight;
            document.documentElement.style.setProperty('--navbar-h', `${h}px`);
        }
    };
    setNavH();
    window.addEventListener('resize', setNavH);
    if (window.ResizeObserver && nav) {
        const ro = new ResizeObserver(() => setNavH());
        ro.observe(nav);
    }
});