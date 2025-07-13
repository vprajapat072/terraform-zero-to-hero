<!DOCTYPE html>
<div class="contact-page">
    <!-- Contact Hero Section -->
    <div class="contact-hero bg-gradient-primary text-white py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 mb-3">Get in Touch</h1>
                    <p class="lead mb-4">
                        Have questions about our courses? Need career guidance? We're here to help you 
                        start your journey in technology.
                    </p>
                    <div class="hero-stats row">
                        <div class="col-md-4 mb-3">
                            <div class="stat-item">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <div class="stat-text">
                                    <strong>24 Hours</strong><br>
                                    <small>Average Response Time</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="stat-item">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <div class="stat-text">
                                    <strong>1000+</strong><br>
                                    <small>Happy Students</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="stat-item">
                                <i class="fas fa-star fa-2x mb-2"></i>
                                <div class="stat-text">
                                    <strong>4.9/5</strong><br>
                                    <small>Student Rating</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Content -->
    <div class="contact-content py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Form -->
                <div class="col-lg-8 mb-5">
                    <div class="contact-form-section">
                        <h2 class="h3 mb-4">Send us a Message</h2>
                        
                        <!-- Success/Error Messages -->
                        <div id="contactMessage" class="alert" style="display: none;"></div>
                        
                        <form id="contactForm" class="contact-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inquiry_type" class="form-label">Inquiry Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="inquiry_type" name="inquiry_type" required>
                                        <option value="">Choose inquiry type...</option>
                                        <option value="general">General Information</option>
                                        <option value="course">Course Details</option>
                                        <option value="admission">Admission Process</option>
                                        <option value="career">Career Guidance</option>
                                        <option value="technical">Technical Support</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5" required 
                                          placeholder="Please describe your inquiry in detail..."></textarea>
                                <div class="invalid-feedback"></div>
                                <div class="form-text">Minimum 10 characters required</div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="privacy_agree" required>
                                    <label class="form-check-label" for="privacy_agree">
                                        I agree to the <a href="#" class="text-primary">Privacy Policy</a> and 
                                        <a href="#" class="text-primary">Terms of Service</a>
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="col-lg-4">
                    <div class="contact-info-section">
                        <h2 class="h3 mb-4">Contact Information</h2>
                        
                        <!-- Contact Cards -->
                        <div class="contact-info-cards">
                            <!-- Phone -->
                            <div class="contact-card card mb-3">
                                <div class="card-body">
                                    <div class="contact-card-icon">
                                        <i class="fas fa-phone text-primary"></i>
                                    </div>
                                    <div class="contact-card-content">
                                        <h5 class="card-title">Call Us</h5>
                                        <p class="card-text">
                                            <a href="tel:<?= str_replace(['+', '-', ' '], '', $contactInfo['phone']) ?>" 
                                               class="text-decoration-none">
                                                <?= $contactInfo['phone'] ?>
                                            </a>
                                        </p>
                                        <small class="text-muted"><?= $contactInfo['timings'] ?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="contact-card card mb-3">
                                <div class="card-body">
                                    <div class="contact-card-icon">
                                        <i class="fas fa-envelope text-success"></i>
                                    </div>
                                    <div class="contact-card-content">
                                        <h5 class="card-title">Email Us</h5>
                                        <p class="card-text">
                                            <a href="mailto:<?= $contactInfo['email'] ?>" 
                                               class="text-decoration-none">
                                                <?= $contactInfo['email'] ?>
                                            </a>
                                        </p>
                                        <small class="text-muted">We reply within 24 hours</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="contact-card card mb-3">
                                <div class="card-body">
                                    <div class="contact-card-icon">
                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                    </div>
                                    <div class="contact-card-content">
                                        <h5 class="card-title">Visit Us</h5>
                                        <p class="card-text"><?= $contactInfo['address'] ?></p>
                                        <small class="text-muted"><?= $contactInfo['timings'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="social-media mt-4">
                            <h5 class="mb-3">Follow Us</h5>
                            <div class="social-links">
                                <a href="#" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm me-2 mb-2">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm me-2 mb-2">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm me-2 mb-2">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                        
                        <!-- Quick Links -->
                        <div class="quick-contact-links mt-4">
                            <h5 class="mb-3">Quick Actions</h5>
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('courses') ?>" class="btn btn-outline-success">
                                    <i class="fas fa-graduation-cap me-2"></i>Browse Courses
                                </a>
                                <a href="<?= base_url('admission') ?>" class="btn btn-outline-warning">
                                    <i class="fas fa-file-alt me-2"></i>Apply Now
                                </a>
                                <a href="<?= base_url('faq') ?>" class="btn btn-outline-info">
                                    <i class="fas fa-question-circle me-2"></i>View FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12">
                    <div class="map-container" style="height: 400px; position: relative;">
                        <iframe 
                            src="<?= $contactInfo['map_embed'] ?>"
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        
                        <!-- Map Overlay -->
                        <div class="map-overlay">
                            <div class="map-info card">
                                <div class="card-body">
                                    <h5 class="card-title">Visit Our Campus</h5>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <?= $contactInfo['address'] ?>
                                        </small>
                                    </p>
                                    <a href="https://maps.google.com/?q=R-CAT+Institute+Jaipur" 
                                       target="_blank" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-directions me-1"></i>
                                        Get Directions
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Track Inquiry Section -->
    <div class="track-inquiry py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h3 class="h4 mb-3">Track Your Inquiry</h3>
                    <p class="text-muted mb-4">
                        Already submitted an inquiry? Track its status using your tracking ID.
                    </p>
                    
                    <div class="track-form">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   id="trackingId" 
                                   placeholder="Enter your tracking ID (e.g., RCT12345ABC)">
                            <button class="btn btn-outline-primary" 
                                    type="button" 
                                    id="trackBtn">
                                <i class="fas fa-search"></i> Track
                            </button>
                        </div>
                        
                        <div id="trackingResult" class="mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageDiv = document.getElementById('contactMessage');
    const trackBtn = document.getElementById('trackBtn');
    const trackingInput = document.getElementById('trackingId');
    const trackingResult = document.getElementById('trackingResult');

    // Contact form submission
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        
        // Clear previous errors
        clearFormErrors();
        
        fetch('<?= base_url('contact/submit') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('success', data.message);
                contactForm.reset();
                
                // Scroll to message
                messageDiv.scrollIntoView({ behavior: 'smooth' });
            } else {
                if (data.errors) {
                    displayFormErrors(data.errors);
                }
                showMessage('danger', data.message || 'Please correct the errors below.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('danger', 'An error occurred. Please try again.');
        })
        .finally(() => {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Send Message';
        });
    });

    // Tracking functionality
    trackBtn.addEventListener('click', function() {
        const trackingId = trackingInput.value.trim();
        
        if (!trackingId) {
            showTrackingResult('danger', 'Please enter a tracking ID.');
            return;
        }
        
        trackBtn.disabled = true;
        trackBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        fetch(`<?= base_url('contact/track') ?>?id=${encodeURIComponent(trackingId)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const submission = data.data;
                let html = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${submission.subject}</h5>
                            <p class="card-text">
                                <strong>Status:</strong> 
                                <span class="badge bg-primary">${submission.status}</span>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Submitted: ${submission.submitted_date}
                                </small>
                            </p>
                            ${submission.response ? `
                                <div class="mt-3">
                                    <strong>Response:</strong>
                                    <p class="mt-1">${submission.response}</p>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
                showTrackingResult('success', html);
            } else {
                showTrackingResult('danger', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showTrackingResult('danger', 'Error retrieving tracking information.');
        })
        .finally(() => {
            trackBtn.disabled = false;
            trackBtn.innerHTML = '<i class="fas fa-search"></i> Track';
        });
    });

    // Enter key for tracking
    trackingInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            trackBtn.click();
        }
    });

    function showMessage(type, message) {
        messageDiv.className = `alert alert-${type}`;
        messageDiv.innerHTML = message;
        messageDiv.style.display = 'block';
    }

    function showTrackingResult(type, content) {
        if (type === 'success') {
            trackingResult.innerHTML = content;
        } else {
            trackingResult.innerHTML = `<div class="alert alert-${type}">${content}</div>`;
        }
        trackingResult.style.display = 'block';
    }

    function clearFormErrors() {
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = '';
            }
        });
    }

    function displayFormErrors(errors) {
        Object.keys(errors).forEach(field => {
            const input = contactForm.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const feedback = input.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = errors[field];
                }
            }
        });
    }
});
</script>

<!-- Contact Styles -->
<style>
.contact-page .hero-stats .stat-item {
    text-align: center;
}

.contact-card {
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.contact-card:hover {
    transform: translateY(-2px);
}

.contact-card .card-body {
    display: flex;
    align-items: center;
    padding: 1.5rem;
}

.contact-card-icon {
    font-size: 1.5rem;
    margin-right: 1rem;
    width: 50px;
    text-align: center;
}

.contact-card-content {
    flex: 1;
}

.contact-card .card-title {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.map-overlay {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 1000;
}

.map-info {
    max-width: 300px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.social-links a {
    transition: transform 0.2s;
}

.social-links a:hover {
    transform: translateY(-2px);
}

.contact-form .form-control:focus,
.contact-form .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.track-form .input-group {
    max-width: 400px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .contact-page .hero-stats {
        margin-top: 2rem;
    }
    
    .map-overlay {
        position: static;
        padding: 20px;
        background: rgba(255, 255, 255, 0.95);
    }
    
    .map-info {
        max-width: none;
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .contact-card .card-body {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-card-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
}
</style>
