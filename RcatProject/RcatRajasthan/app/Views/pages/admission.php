<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="fade-in">Admission Process</h1>
                    <p class="fade-in">Start your journey towards a successful career with R-CAT Rajasthan. Follow our simple admission process to secure your spot in our industry-focused courses.</p>
                    <div class="fade-in">
                        <a href="#admission-steps" class="btn btn-light btn-hero">
                            <i class="bi bi-arrow-down me-2"></i>
                            Learn Process
                        </a>
                        <a href="#apply-now" class="btn btn-outline-light btn-hero">
                            <i class="bi bi-person-plus me-2"></i>
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center fade-in">
                    <img src="/assets/images/admission-hero.svg" alt="Admission Process" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Important Dates Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Important Dates</h2>
            <p class="section-subtitle">Mark your calendar with these key admission dates</p>
        </div>
        
        <div class="row">
            <?php foreach ($importantDates as $date): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card date-card fade-in">
                    <div class="card-body text-center">
                        <div class="date-icon mb-3">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h5 class="card-title"><?= htmlspecialchars($date['event']) ?></h5>
                        <p class="date-value"><?= Utils::formatDate($date['date']) ?></p>
                        <span class="badge bg-<?= $date['status'] === 'upcoming' ? 'primary' : 'success' ?>">
                            <?= ucfirst($date['status']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Admission Steps Section -->
<section class="section" id="admission-steps">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Admission Process</h2>
            <p class="section-subtitle">Follow these simple steps to secure your admission</p>
        </div>
        
        <div class="admission-timeline">
            <?php foreach ($admissionSteps as $index => $step): ?>
            <div class="timeline-item fade-in">
                <div class="timeline-marker">
                    <div class="timeline-number"><?= $step['step'] ?></div>
                </div>
                <div class="timeline-content">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="step-content">
                                <h3 class="step-title">
                                    <i class="<?= $step['icon'] ?> me-2 text-primary"></i>
                                    <?= htmlspecialchars($step['title']) ?>
                                </h3>
                                <p class="step-description"><?= htmlspecialchars($step['description']) ?></p>
                                <ul class="step-details">
                                    <?php foreach ($step['details'] as $detail): ?>
                                    <li><?= htmlspecialchars($detail) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="step-visual text-center">
                                <div class="step-icon">
                                    <i class="<?= $step['icon'] ?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Required Documents Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title fade-in">
                    <h2>Required Documents</h2>
                    <p class="section-subtitle">Prepare these documents for your application</p>
                </div>
                
                <div class="document-list fade-in">
                    <?php foreach ($requiredDocuments as $document): ?>
                    <div class="document-item">
                        <i class="bi bi-file-earmark-check text-success me-3"></i>
                        <span><?= htmlspecialchars($document) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="mt-4 fade-in">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Note:</strong> All documents should be scanned and uploaded in PDF format. Original documents will be verified during admission.
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="document-checklist fade-in">
                    <h3>Document Checklist</h3>
                    <div class="checklist-card">
                        <div class="checklist-header">
                            <i class="bi bi-clipboard-check text-primary"></i>
                            <h4>Before You Apply</h4>
                        </div>
                        <div class="checklist-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1">
                                <label class="form-check-label" for="check1">
                                    Educational certificates ready
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check2">
                                <label class="form-check-label" for="check2">
                                    Identity proof available
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check3">
                                <label class="form-check-label" for="check3">
                                    Recent photographs ready
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check4">
                                <label class="form-check-label" for="check4">
                                    Category certificate (if applicable)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check5">
                                <label class="form-check-label" for="check5">
                                    Income certificate for concession
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fee Structure Section -->
<section class="section">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Fee Structure</h2>
            <p class="section-subtitle">Transparent and affordable fee structure with various concessions</p>
        </div>
        
        <div class="row">
            <?php foreach ($feeStructure as $fee): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card fee-card fade-in">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0"><?= htmlspecialchars($fee['category']) ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="fee-item">
                            <span class="fee-label">Application Fee</span>
                            <span class="fee-value"><?= htmlspecialchars($fee['application_fee']) ?></span>
                        </div>
                        <div class="fee-item">
                            <span class="fee-label">Course Fee Range</span>
                            <span class="fee-value"><?= htmlspecialchars($fee['course_fee_range']) ?></span>
                        </div>
                        <div class="fee-concession">
                            <i class="bi bi-tag text-success me-2"></i>
                            <small><?= htmlspecialchars($fee['concession']) ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-4 fade-in">
            <div class="alert alert-success">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Payment Options:</strong> Online payment, Bank transfer, Demand draft, and EMI options available for course fees.
            </div>
        </div>
    </div>
</section>

<!-- Eligibility Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-title fade-in">
                    <h2>Eligibility Criteria</h2>
                    <p class="section-subtitle">General eligibility requirements for R-CAT courses</p>
                </div>
                
                <div class="eligibility-content fade-in">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="bi bi-mortarboard text-primary me-2"></i>Educational Qualification</h4>
                            <ul>
                                <li>Minimum 10+2 for diploma courses</li>
                                <li>Graduation for advanced courses</li>
                                <li>Specific subject requirements vary by course</li>
                                <li>Minimum 50% marks required</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="bi bi-person text-primary me-2"></i>Age Limit</h4>
                            <ul>
                                <li>Minimum age: 18 years</li>
                                <li>Maximum age: 35 years</li>
                                <li>Age relaxation for reserved categories</li>
                                <li>No age limit for professional courses</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h4><i class="bi bi-exclamation-triangle text-warning me-2"></i>Special Requirements</h4>
                        <p>Some courses may have additional requirements:</p>
                        <ul>
                            <li>Work experience for professional courses</li>
                            <li>Basic computer knowledge</li>
                            <li>English proficiency</li>
                            <li>Medical fitness certificate (for specific courses)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Form Section -->
<section class="section" id="apply-now">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="application-form-card fade-in">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">
                            <i class="bi bi-person-plus me-2"></i>
                            Apply Now
                        </h3>
                        <p class="mb-0 mt-2">Start your application process today</p>
                    </div>
                    <div class="card-body">
                        <form id="applicationForm" class="application-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="firstName" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" id="phone" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="course" class="form-label">Preferred Course *</label>
                                        <select class="form-select" id="course" required>
                                            <option value="">Select Course</option>
                                            <option value="cloud-computing">Cloud Computing</option>
                                            <option value="ai-ml">Artificial Intelligence & ML</option>
                                            <option value="cybersecurity">Cybersecurity</option>
                                            <option value="web-development">Web Development</option>
                                            <option value="data-science">Data Science</option>
                                            <option value="digital-marketing">Digital Marketing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select" id="category">
                                            <option value="general">General</option>
                                            <option value="sc">SC</option>
                                            <option value="st">ST</option>
                                            <option value="obc">OBC</option>
                                            <option value="ews">EWS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="qualification" class="form-label">Highest Qualification *</label>
                                <select class="form-select" id="qualification" required>
                                    <option value="">Select Qualification</option>
                                    <option value="10th">10th Pass</option>
                                    <option value="12th">12th Pass</option>
                                    <option value="diploma">Diploma</option>
                                    <option value="graduation">Graduation</option>
                                    <option value="postgraduation">Post Graduation</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="experience" class="form-label">Work Experience (if any)</label>
                                <textarea class="form-control" id="experience" rows="3" placeholder="Brief description of your work experience"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="motivation" class="form-label">Why do you want to join this course? *</label>
                                <textarea class="form-control" id="motivation" rows="4" required placeholder="Tell us about your motivation and career goals"></textarea>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="/terms">Terms and Conditions</a> and <a href="/privacy">Privacy Policy</a> *
                                </label>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    I want to receive updates about courses and admission notifications
                                </label>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send me-2"></i>
                                    Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Admission FAQs</h2>
            <p class="section-subtitle">Common questions about the admission process</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>When can I apply for admission?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Applications are open throughout the year. However, we have specific batch start dates. Check our important dates section for the latest information.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>Is there an entrance exam?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Most courses have merit-based admission. Some advanced courses may require an entrance test or interview. This will be mentioned in the course details.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>Can I apply for multiple courses?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, you can apply for multiple courses by submitting separate applications for each course. However, you can only enroll in one course at a time.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>What if I miss the application deadline?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Late applications may be considered based on seat availability. A late application fee may apply. Contact our admission office for more information.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="admission-contact fade-in">
                    <h2>Need Help with Admission?</h2>
                    <p class="lead">Our admission counselors are here to help you throughout the process.</p>
                    
                    <div class="contact-options">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="bi bi-telephone text-primary"></i>
                                    <h5>Call Us</h5>
                                    <p>+91-1234567890</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="bi bi-envelope text-primary"></i>
                                    <h5>Email Us</h5>
                                    <p>admissions@rcatrajasthan.com</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="bi bi-chat-dots text-primary"></i>
                                    <h5>Live Chat</h5>
                                    <p>Available 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.date-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.date-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.date-icon {
    font-size: 2.5rem;
    color: var(--primary-color);
}

.date-value {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary-color);
}

.admission-timeline {
    position: relative;
    padding: 2rem 0;
}

.timeline-item {
    position: relative;
    margin-bottom: 3rem;
    padding-left: 100px;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 60px;
    height: 60px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}

.timeline-number {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 29px;
    top: 60px;
    width: 2px;
    height: calc(100% + 3rem);
    background: #e9ecef;
    z-index: 1;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-content {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.step-title {
    color: var(--dark-color);
    margin-bottom: 1rem;
}

.step-description {
    color: var(--secondary-color);
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

.step-details {
    list-style: none;
    padding: 0;
}

.step-details li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.step-details li:last-child {
    border-bottom: none;
}

.step-details li::before {
    content: '✓';
    color: var(--success-color);
    font-weight: bold;
    margin-right: 0.5rem;
}

.step-icon {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    margin: 0 auto;
}

.document-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.checklist-card {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.checklist-header {
    text-align: center;
    margin-bottom: 2rem;
}

.checklist-header i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.form-check {
    margin-bottom: 1rem;
    padding: 0.5rem;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.form-check:hover {
    background-color: #f8f9fa;
}

.fee-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.fee-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.fee-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.fee-item:last-child {
    border-bottom: none;
}

.fee-label {
    font-weight: 500;
    color: var(--secondary-color);
}

.fee-value {
    font-weight: 600;
    color: var(--primary-color);
}

.fee-concession {
    margin-top: 1rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 5px;
}

.application-form-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.contact-item {
    text-align: center;
    padding: 2rem;
}

.contact-item i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.contact-item h5 {
    margin-bottom: 0.5rem;
    color: var(--dark-color);
}

.contact-item p {
    color: var(--secondary-color);
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .timeline-item {
        padding-left: 80px;
    }
    
    .timeline-marker {
        width: 50px;
        height: 50px;
    }
    
    .timeline-number {
        font-size: 1.2rem;
    }
    
    .timeline-item::before {
        left: 24px;
    }
    
    .step-icon {
        width: 100px;
        height: 100px;
        font-size: 2.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const applicationForm = document.getElementById('applicationForm');
    
    applicationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing...';
        submitBtn.disabled = true;
        
        // Simulate form submission
        setTimeout(() => {
            // Show success message
            const successAlert = document.createElement('div');
            successAlert.className = 'alert alert-success alert-dismissible fade show';
            successAlert.innerHTML = `
                <i class="bi bi-check-circle me-2"></i>
                <strong>Application Submitted Successfully!</strong> We will contact you within 24 hours.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            this.insertBefore(successAlert, this.firstChild);
            
            // Reset form
            this.reset();
            
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            
            // Scroll to success message
            successAlert.scrollIntoView({ behavior: 'smooth' });
        }, 2000);
    });
    
    // Document checklist functionality
    const checkboxes = document.querySelectorAll('.form-check-input');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.style.textDecoration = 'line-through';
                label.style.color = '#6c757d';
            } else {
                label.style.textDecoration = 'none';
                label.style.color = 'inherit';
            }
        });
    });
    
    // Phone number validation
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
    
    // Course selection based on qualification
    const qualificationSelect = document.getElementById('qualification');
    const courseSelect = document.getElementById('course');
    
    qualificationSelect.addEventListener('change', function() {
        const qualification = this.value;
        const courses = courseSelect.querySelectorAll('option');
        
        courses.forEach(option => {
            if (option.value === '') return;
            
            // Show/hide courses based on qualification
            if (qualification === '10th') {
                option.style.display = ['web-development', 'digital-marketing'].includes(option.value) ? 'block' : 'none';
            } else if (qualification === '12th') {
                option.style.display = ['web-development', 'digital-marketing', 'cybersecurity'].includes(option.value) ? 'block' : 'none';
            } else {
                option.style.display = 'block';
            }
        });
    });
});
</script>
