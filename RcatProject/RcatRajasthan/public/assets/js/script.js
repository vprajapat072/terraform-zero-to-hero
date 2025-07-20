document.addEventListener('DOMContentLoaded', function() {
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

    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu close on link click
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });

    // Form validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Newsletter subscription
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                // Here you would typically send the email to your backend
                showNotification('Thank you for subscribing!', 'success');
                this.reset();
            }
        });
    }

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const searchResults = document.querySelector('.search-results');
            
            if (query.length > 2) {
                // Simulate search results
                searchResults.innerHTML = `
                    <div class="list-group">
                        <a href="/courses/cloud-computing" class="list-group-item list-group-item-action">
                            <strong>Cloud Computing Course</strong>
                            <p class="mb-1">Learn AWS, Azure, and Google Cloud</p>
                        </a>
                        <a href="/courses/artificial-intelligence" class="list-group-item list-group-item-action">
                            <strong>Artificial Intelligence Course</strong>
                            <p class="mb-1">Master AI and Machine Learning</p>
                        </a>
                    </div>
                `;
                searchResults.style.display = 'block';
            } else {
                searchResults.style.display = 'none';
            }
        });
    }

    // Lazy loading for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // Course comparison functionality
    const compareButtons = document.querySelectorAll('.compare-btn');
    let compareList = JSON.parse(localStorage.getItem('compareList') || '[]');

    compareButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const courseId = this.dataset.courseId;
            const courseName = this.dataset.courseName;
            
            if (compareList.find(item => item.id === courseId)) {
                // Remove from comparison
                compareList = compareList.filter(item => item.id !== courseId);
                this.classList.remove('active');
                this.innerHTML = '<i class="bi bi-plus"></i> Compare';
            } else {
                // Add to comparison (max 3 courses)
                if (compareList.length < 3) {
                    compareList.push({id: courseId, name: courseName});
                    this.classList.add('active');
                    this.innerHTML = '<i class="bi bi-check"></i> Added';
                } else {
                    showNotification('You can compare maximum 3 courses at a time', 'warning');
                }
            }
            
            localStorage.setItem('compareList', JSON.stringify(compareList));
            updateCompareWidget();
        });
    });

    function updateCompareWidget() {
        const compareWidget = document.querySelector('.compare-widget');
        if (compareWidget) {
            if (compareList.length > 0) {
                compareWidget.style.display = 'block';
                compareWidget.querySelector('.compare-count').textContent = compareList.length;
            } else {
                compareWidget.style.display = 'none';
            }
        }
    }

    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show notification`;
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    // Course filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const courseCards = document.querySelectorAll('.course-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter courses
            courseCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                    card.classList.add('fade-in');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // FAQ accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        question.addEventListener('click', function() {
            const isOpen = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(i => {
                i.classList.remove('active');
                i.querySelector('.faq-answer').style.display = 'none';
            });
            
            // Toggle current item
            if (!isOpen) {
                item.classList.add('active');
                answer.style.display = 'block';
            }
        });
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function() {
            const loadTime = performance.now();
            console.log(`Page loaded in ${loadTime.toFixed(2)}ms`);
            
            // Send performance data to analytics (if needed)
            if (typeof gtag !== 'undefined') {
                gtag('event', 'page_load_time', {
                    value: Math.round(loadTime),
                    custom_parameter: 'performance'
                });
            }
        });
    }

    // Social Media Sharing Functions
    function sharePost(title, url) {
        if (navigator.share) {
            // Use native Web Share API if available
            navigator.share({
                title: title,
                url: url,
                text: `Check out this article: ${title}`
            }).catch(console.error);
        } else {
            // Fallback to custom sharing modal
            showShareModal(title, url);
        }
    }

    function showShareModal(title, url) {
        const encodedTitle = encodeURIComponent(title);
        const encodedUrl = encodeURIComponent(url);
        const encodedText = encodeURIComponent(`Check out this article: ${title}`);
        
        const shareOptions = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
            twitter: `https://twitter.com/intent/tweet?text=${encodedText}&url=${encodedUrl}`,
            linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`,
            whatsapp: `https://wa.me/?text=${encodedText}%20${encodedUrl}`,
            telegram: `https://t.me/share/url?url=${encodedUrl}&text=${encodedText}`,
            email: `mailto:?subject=${encodedTitle}&body=${encodedText}%20${encodedUrl}`
        };
        
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="shareModal" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Share Article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-grid gap-2">
                                <a href="${shareOptions.facebook}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-facebook me-2"></i>Facebook
                                </a>
                                <a href="${shareOptions.twitter}" target="_blank" class="btn btn-info">
                                    <i class="bi bi-twitter me-2"></i>Twitter
                                </a>
                                <a href="${shareOptions.linkedin}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-linkedin me-2"></i>LinkedIn
                                </a>
                                <a href="${shareOptions.whatsapp}" target="_blank" class="btn btn-success">
                                    <i class="bi bi-whatsapp me-2"></i>WhatsApp
                                </a>
                                <a href="${shareOptions.telegram}" target="_blank" class="btn btn-info">
                                    <i class="bi bi-telegram me-2"></i>Telegram
                                </a>
                                <a href="${shareOptions.email}" class="btn btn-secondary">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </a>
                                <button class="btn btn-outline-primary" onclick="copyToClipboard('${url}')">
                                    <i class="bi bi-clipboard me-2"></i>Copy Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing modal if any
        const existingModal = document.getElementById('shareModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Add modal to page
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        
        // Show modal
        const shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
        shareModal.show();
        
        // Clean up modal after it's hidden
        document.getElementById('shareModal').addEventListener('hidden.bs.modal', function() {
            this.remove();
        });
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            showToast('Link copied to clipboard!', 'success');
        }).catch(function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showToast('Link copied to clipboard!', 'success');
        });
    }

    function showToast(message, type = 'info') {
        const toastHTML = `
            <div class="toast align-items-center text-white bg-${type} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;
        
        let toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainer';
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastElement = toastContainer.lastElementChild;
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
        
        // Remove toast element after it's hidden
        toastElement.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }

    // Newsletter Subscription
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletterForm');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input[type="email"]').value;
                
                // Here you would typically send to your backend
                // For demo, we'll just show a success message
                showToast('Thank you for subscribing to our newsletter!', 'success');
                this.reset();
            });
        }
    });
});

// CSS for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    .notification {
        animation: slideIn 0.3s ease;
    }
    
    .navbar.scrolled {
        background-color: rgba(13, 110, 253, 0.95) !important;
        backdrop-filter: blur(10px);
    }
    
    .lazy {
        opacity: 0.5;
        transition: opacity 0.3s;
    }
    
    .compare-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        display: none;
    }
    
    .faq-item {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    
    .faq-question {
        background: #f8f9fa;
        padding: 15px 20px;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background 0.3s ease;
    }
    
    .faq-question:hover {
        background: #e9ecef;
    }
    
    .faq-question::after {
        content: '+';
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .faq-item.active .faq-question::after {
        transform: rotate(45deg);
    }
    
    .faq-answer {
        padding: 15px 20px;
        display: none;
        background: white;
    }
`;
document.head.appendChild(style);
