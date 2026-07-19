/* ============================================
   ANIMATIONS JS - Healthcare Platform
   Advanced scroll & interactive animations
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // Parallax Effect on Hero
    // ==========================================
    const heroSection = document.querySelector('.hero');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrollY = window.scrollY;
            const heroVisual = heroSection.querySelector('.hero-visual');
            if (heroVisual && scrollY < window.innerHeight) {
                heroVisual.style.transform = 'translateY(' + (scrollY * 0.15) + 'px)';
            }
        });
    }

    // ==========================================
    // Tilt Effect on Service Cards
    // ==========================================
    document.querySelectorAll('.service-card').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const tiltX = ((y - centerY) / centerY) * 3;
            const tiltY = ((centerX - x) / centerX) * 3;

            card.style.transform = 'perspective(1000px) rotateX(' + tiltX + 'deg) rotateY(' + tiltY + 'deg) translateY(-10px)';
        });

        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });

    // ==========================================
    // Magnetic Button Effect
    // ==========================================
    document.querySelectorAll('.btn-primary, .btn-outline').forEach(function(btn) {
        btn.addEventListener('mousemove', function(e) {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = 'translate(' + (x * 0.15) + 'px, ' + (y * 0.15 - 3) + 'px)';
        });

        btn.addEventListener('mouseleave', function() {
            btn.style.transform = 'translate(0, 0)';
        });
    });

    // ==========================================
    // Staggered Card Animations
    // ==========================================
    const cardGroups = document.querySelectorAll('.cards-grid, .features-grid');
    cardGroups.forEach(function(group) {
        const cards = group.children;
        const groupObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    Array.from(cards).forEach(function(card, index) {
                        setTimeout(function() {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 120);
                    });
                    groupObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        // Set initial state
        Array.from(cards).forEach(function(card) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        groupObserver.observe(group);
    });

    // ==========================================
    // Floating Particles Generator
    // ==========================================
    const particlesContainer = document.querySelector('.particles');
    if (particlesContainer) {
        for (var i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.setProperty('--duration', (6 + Math.random() * 8) + 's');
            particle.style.setProperty('--delay', (Math.random() * 5) + 's');
            particle.style.width = (2 + Math.random() * 4) + 'px';
            particle.style.height = particle.style.width;
            particlesContainer.appendChild(particle);
        }
    }

    // ==========================================
    // Text Reveal Animation
    // ==========================================
    const textReveals = document.querySelectorAll('.text-reveal');
    textReveals.forEach(function(el) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    el.classList.add('revealed');
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.2 });
        observer.observe(el);
    });

    // ==========================================
    // Navbar Color Change on Service Pages
    // ==========================================
    const pageHero = document.querySelector('.page-hero');
    if (pageHero) {
        const navbarEl = document.querySelector('.navbar');
        if (navbarEl) {
            navbarEl.classList.remove('scrolled');
        }
    }

    // ==========================================
    // Ripple Effect on Buttons
    // ==========================================
    document.querySelectorAll('.btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = 'position:absolute;width:' + size + 'px;height:' + size + 'px;left:' + x + 'px;top:' + y + 'px;background:rgba(255,255,255,0.3);border-radius:50%;transform:scale(0);animation:ripple 0.6s ease-out;pointer-events:none;';
            button.style.position = 'relative';
            button.style.overflow = 'hidden';
            button.appendChild(ripple);

            setTimeout(function() {
                ripple.remove();
            }, 600);
        });
    });

});
