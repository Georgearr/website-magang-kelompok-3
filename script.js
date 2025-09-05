// Memoria Aeterna OSIS Website JavaScript

// Mobile navigation
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Close menu when clicking on nav links
    document.querySelectorAll('.nav-link').forEach(n => n.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
    }));
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Competition card click handler
function openCompetition(competitionId) {
    window.location.href = `competition.php?id=${competitionId}`;
}

// Animations on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
        }
    });
}, observerOptions);

// Observe elements for animation
document.querySelectorAll('.competition-card, .detail-item, .video-item').forEach(el => {
    observer.observe(el);
});

// Form validation for competition registration
if (document.querySelector('form[method="POST"]')) {
    const form = document.querySelector('form[method="POST"]');
    
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const className = document.getElementById('class').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const agree = document.getElementById('agree').checked;
        
        if (!name || !className || !phone) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return false;
        }
        
        if (!agree) {
            e.preventDefault();
            alert('Anda harus menyetujui syarat dan ketentuan lomba!');
            return false;
        }
        
        // Phone number validation (Indonesian format)
        const phonePattern = /^(08|62|0|8)[0-9]{8,12}$/;
        if (!phonePattern.test(phone.replace(/[^0-9]/g, ''))) {
            e.preventDefault();
            alert('Format nomor HP tidak valid!');
            return false;
        }
    });
}

// Add loading animation for form submission
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.querySelector('.submit-btn');
    if (submitBtn) {
        const form = submitBtn.closest('form');
        form.addEventListener('submit', function() {
            submitBtn.innerHTML = 'Mendaftar...';
            submitBtn.disabled = true;
        });
    }
});

// Particle animation for the main section
function createParticles() {
    const particlesContainer = document.querySelector('.particles-container');
    if (!particlesContainer) return;
    
    // Create additional particles
    for (let i = 0; i < 10; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 2 + 's';
        particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
        particlesContainer.appendChild(particle);
    }
}

// Initialize particles
createParticles();

// Floating shapes animation
document.addEventListener('DOMContentLoaded', function() {
    const shapes = document.querySelectorAll('.shape');
    shapes.forEach((shape, index) => {
        shape.style.animationDelay = (index * 0.5) + 's';
    });
});