/* ============================================
   MAIN JS - Healthcare Platform
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // Page Loader
    // ==========================================
    const loader = document.querySelector('.page-loader');
    if (loader) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                loader.classList.add('hidden');
            }, 600);
        });
        // Fallback: hide after 3 seconds
        setTimeout(function() {
            if (loader && !loader.classList.contains('hidden')) {
                loader.classList.add('hidden');
            }
        }, 3000);
    }

    // ==========================================
    // Sticky Navbar
    // ==========================================
    const navbar = document.querySelector('.navbar');
    function handleScroll() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // initial check

    // ==========================================
    // Mobile Navigation
    // ==========================================
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    const navOverlay = document.querySelector('.nav-overlay');

    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
            if (navOverlay) navOverlay.classList.toggle('active');
            document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
        });
    }

    if (navOverlay) {
        navOverlay.addEventListener('click', function() {
            navToggle.classList.remove('active');
            navLinks.classList.remove('active');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Close menu on link click
    document.querySelectorAll('.nav-link').forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 1024) {
                navToggle.classList.remove('active');
                navLinks.classList.remove('active');
                if (navOverlay) navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // ==========================================
    // Mobile Dropdown Toggle
    // ==========================================
    document.querySelectorAll('.nav-dropdown').forEach(function(dropdown) {
        const link = dropdown.querySelector('.nav-link');
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                dropdown.classList.toggle('active');
            }
        });
    });

    // ==========================================
    // Smooth Scrolling
    // ==========================================
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = navbar.offsetHeight + 20;
                const targetPos = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({
                    top: targetPos,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ==========================================
    // Animated Counters
    // ==========================================
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-target'));
        const suffix = el.getAttribute('data-suffix') || '';
        const prefix = el.getAttribute('data-prefix') || '';
        const duration = 2000;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // Ease out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(eased * target);
            el.textContent = prefix + current.toLocaleString() + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.textContent = prefix + target.toLocaleString() + suffix;
            }
        }

        requestAnimationFrame(update);
    }

    // ==========================================
    // Scroll Reveal / Intersection Observer
    // ==========================================
    const revealElements = document.querySelectorAll('.fade-in-up, .fade-in-down, .fade-in-left, .fade-in-right, .scale-in');
    const counterElements = document.querySelectorAll('[data-target]');
    const animatedCounters = new Set();

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');

                // Check if it's a counter element
                if (entry.target.hasAttribute('data-target') && !animatedCounters.has(entry.target)) {
                    animatedCounters.add(entry.target);
                    animateCounter(entry.target);
                }
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(function(el) {
        observer.observe(el);
    });

    counterElements.forEach(function(el) {
        observer.observe(el);
    });

    // ==========================================
    // Scroll Indicator Click
    // ==========================================
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const nextSection = document.querySelector('.hero + section, .hero + .section, .hero ~ section');
            if (nextSection) {
                const offset = navbar.offsetHeight + 20;
                const targetPos = nextSection.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({
                    top: targetPos,
                    behavior: 'smooth'
                });
            }
        });
    }

    // ==========================================
    // Active Nav Link Detection
    // ==========================================
    function setActiveNav() {
        const path = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(function(link) {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href && path.includes(href) && href !== '#') {
                link.classList.add('active');
            }
        });
    }
    setActiveNav();

    // ==========================================
    // Add page transition class
    // ==========================================
    document.body.classList.add('page-transition');

});
