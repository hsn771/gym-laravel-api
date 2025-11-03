document.addEventListener('DOMContentLoaded', function () {
    // Gallery Filter
    const filterButtons = document.querySelectorAll('.gallery-filter button');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Filter gallery items
            const filter = button.getAttribute('data-filter');

            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');

            // Skip if href is just "#"
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.padding = '10px 0';
            navbar.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.padding = '15px 0';
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        }
    });

    // Form submission
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Show success message
            const formAlert = document.createElement('div');
            formAlert.className = 'alert alert-success alert-dismissible fade show mt-3';
            formAlert.innerHTML = `
                        <strong>Success!</strong> Your message has been sent. We'll get back to you soon.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

            contactForm.appendChild(formAlert);
            contactForm.reset();

            // Hide alert after 5 seconds
            setTimeout(() => {
                formAlert.classList.remove('show');
                setTimeout(() => formAlert.remove(), 150);
            }, 5000);
        });
    }

    // Lightbox functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = lightbox.querySelector('img');
    const lightboxClose = document.querySelector('.lightbox-close');
    const galleryImages = document.querySelectorAll('.gallery-item img');

    galleryImages.forEach(img => {
        img.addEventListener('click', function () {
            const imageSrc = this.getAttribute('src');
            lightboxImg.setAttribute('src', imageSrc);
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when lightbox is open
        });
    });

    // Close lightbox when clicking the close button or outside the image
    lightboxClose.addEventListener('click', function () {
        lightbox.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    });

    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        }
    });

    // Close lightbox with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            lightbox.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        }
    });
});