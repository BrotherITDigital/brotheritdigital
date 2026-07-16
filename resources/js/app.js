import './bootstrap';

/* ===== FORCE LIGHT MODE ===== */
document.documentElement.classList.remove('dark');

/* ===== NAVBAR SCROLL ===== */
const navbar = document.getElementById('navbar');
if (navbar) {
    const onScroll = () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

/* ===== PAGE LOADER ===== */
window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    if (loader) {
        setTimeout(() => loader.classList.add('hidden'), 300);
    }
});

/* ===== SCROLL REVEAL ===== */
const revealObserver = new IntersectionObserver(
    (entries) => entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            revealObserver.unobserve(entry.target);
        }
    }),
    { threshold: 0.12, rootMargin: '0px 0px -60px 0px' }
);

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right')
        .forEach(el => revealObserver.observe(el));
});

/* ===== COUNTER ANIMATION ===== */
function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        el.textContent = Math.floor(current).toLocaleString() + (el.dataset.suffix || '');
    }, 16);
}

const counterObserver = new IntersectionObserver(
    (entries) => entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    }),
    { threshold: 0.5 }
);

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.counter-value').forEach(el => counterObserver.observe(el));
});

/* ===== PARTICLES CANVAS ===== */
function initParticles() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let particles = [];
    let raf;

    function resize() {
        canvas.width  = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }

    function Particle() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.vx = (Math.random() - 0.5) * 0.4;
        this.vy = (Math.random() - 0.5) * 0.4;
        this.r  = Math.random() * 1.5 + 0.5;
        this.a  = Math.random() * 0.5 + 0.1;
    }

    function init() {
        particles = Array.from({ length: 80 }, () => new Particle());
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(99,179,237,${p.a})`;
            ctx.fill();

            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0 || p.x > canvas.width)  p.vx *= -1;
            if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
        });

        // Connect nearby particles
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 100) {
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(99,179,237,${0.08 * (1 - dist / 100)})`;
                    ctx.lineWidth = 0.5;
                    ctx.stroke();
                }
            }
        }

        raf = requestAnimationFrame(draw);
    }

    window.addEventListener('resize', () => { resize(); init(); });
    resize();
    init();
    draw();
}

document.addEventListener('DOMContentLoaded', initParticles);

/* ===== FAQ ACCORDION ===== */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.faq-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('open');

            document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        });
    });
});

/* ===== MOBILE MENU ===== */
window.toggleMobileMenu = function () {
    const menu = document.getElementById('mobile-menu');
    const icon  = document.getElementById('menu-icon');
    if (!menu) return;
    menu.classList.toggle('hidden');
    if (icon) icon.classList.toggle('fa-bars');
    if (icon) icon.classList.toggle('fa-times');
};

/* ===== SMOOTH SCROLL FOR ANCHOR LINKS ===== */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});

/* ===== ADMIN SIDEBAR TOGGLE ===== */
window.toggleAdminSidebar = function () {
    const sidebar = document.getElementById('admin-sidebar');
    if (sidebar) sidebar.classList.toggle('open');
};
