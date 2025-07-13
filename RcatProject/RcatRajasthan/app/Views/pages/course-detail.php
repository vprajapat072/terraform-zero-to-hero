<!-- Hero Section -->
<section class="hero-section bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-3">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item"><a href="/courses" class="text-white-50">Courses</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page"><?php echo htmlspecialchars($course['title']); ?></li>
                    </ol>
                </nav>
                
                <h1 class="display-4 fw-bold mb-4"><?php echo htmlspecialchars($course['title']); ?></h1>
                <p class="lead mb-4"><?php echo htmlspecialchars($course['description']); ?></p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="course-meta">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-clock me-2"></i>
                                <span><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-rupee-sign me-2"></i>
                                <span><strong>Fee:</strong> <?php echo htmlspecialchars($course['fee']); ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-layer-group me-2"></i>
                                <span><strong>Level:</strong> <?php echo htmlspecialchars($course['level']); ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-handshake me-2"></i>
                                <span><strong>Partner:</strong> <?php echo htmlspecialchars($course['partner']); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="action-buttons">
                            <a href="#apply" class="btn btn-light btn-lg me-3 mb-2">
                                <i class="fas fa-user-plus me-2"></i>Apply Now
                            </a>
                            <a href="#download" class="btn btn-outline-light btn-lg mb-2">
                                <i class="fas fa-download me-2"></i>Download Brochure
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-image">
                    <img src="<?php echo htmlspecialchars($course['image']); ?>" 
                         alt="<?php echo htmlspecialchars($course['title']); ?>" 
                         class="img-fluid rounded shadow-lg"
                         onerror="this.src='https://via.placeholder.com/600x400/667eea/ffffff?text=Course+Image'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Overview -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-content">
                    <div class="section-header mb-4">
                        <h2 class="h3 fw-bold text-primary">Course Overview</h2>
                        <div class="underline"></div>
                    </div>
                    <p class="lead"><?php echo htmlspecialchars($course['overview']); ?></p>
                    
                    <!-- Curriculum -->
                    <div class="curriculum-section mt-5">
                        <h3 class="h4 fw-bold text-primary mb-4">Curriculum</h3>
                        <div class="row">
                            <?php foreach ($course['curriculum'] as $index => $module): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="curriculum-item">
                                        <div class="d-flex align-items-center">
                                            <div class="module-number">
                                                <span class="badge bg-primary rounded-pill"><?php echo $index + 1; ?></span>
                                            </div>
                                            <div class="module-title ms-3">
                                                <h6 class="mb-0"><?php echo htmlspecialchars($module); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Course Features -->
                    <div class="features-section mt-5">
                        <h3 class="h4 fw-bold text-primary mb-4">What You'll Get</h3>
                        <div class="row">
                            <?php foreach ($course['features'] as $feature): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="feature-item">
                                        <div class="d-flex align-items-start">
                                            <div class="feature-icon">
                                                <i class="fas fa-check-circle text-success me-3"></i>
                                            </div>
                                            <div class="feature-text">
                                                <p class="mb-0"><?php echo htmlspecialchars($feature); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Career Opportunities -->
                    <div class="career-section mt-5">
                        <h3 class="h4 fw-bold text-primary mb-4">Career Opportunities</h3>
                        <div class="row">
                            <?php foreach ($course['career_opportunities'] as $job): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="career-card">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body text-center">
                                                <div class="career-icon mb-3">
                                                    <i class="fas fa-briefcase text-primary fa-2x"></i>
                                                </div>
                                                <h6 class="card-title"><?php echo htmlspecialchars($job); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="course-sidebar">
                    <!-- Course Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>Course Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Duration:</span>
                                    <span><?php echo htmlspecialchars($course['duration']); ?></span>
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Fee:</span>
                                    <span class="text-primary fw-bold"><?php echo htmlspecialchars($course['fee']); ?></span>
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Level:</span>
                                    <span><?php echo htmlspecialchars($course['level']); ?></span>
                                </div>
                            </div>
                            <div class="info-item mb-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Certification:</span>
                                    <span><?php echo htmlspecialchars($course['certification']); ?></span>
                                </div>
                            </div>
                            <div class="info-item mb-4">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Partner:</span>
                                    <span><?php echo htmlspecialchars($course['partner']); ?></span>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="/admission" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Apply Now
                                </a>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i>Download Brochure
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Eligibility Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user-check me-2"></i>Eligibility
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($course['eligibility'] as $requirement): ?>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <?php echo htmlspecialchars($requirement); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Contact Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-phone me-2"></i>Need Help?
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Have questions about this course? Our admission counselors are here to help!</p>
                            <div class="d-grid gap-2">
                                <a href="tel:+919876543210" class="btn btn-info">
                                    <i class="fas fa-phone me-2"></i>Call Now
                                </a>
                                <a href="mailto:info@rcatrajasthan.com" class="btn btn-outline-info">
                                    <i class="fas fa-envelope me-2"></i>Email Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Courses -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold text-primary">Related Courses</h2>
                <p class="text-muted">Explore other courses that might interest you</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="course-icon mb-3">
                            <i class="fas fa-database text-primary fa-3x"></i>
                        </div>
                        <h5 class="card-title">Data Science</h5>
                        <p class="card-text text-muted">Master data analysis, visualization, and machine learning</p>
                        <a href="/courses/data-science" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="course-icon mb-3">
                            <i class="fas fa-mobile-alt text-success fa-3x"></i>
                        </div>
                        <h5 class="card-title">Mobile Development</h5>
                        <p class="card-text text-muted">Build Android and iOS apps with modern frameworks</p>
                        <a href="/courses/mobile-development" class="btn btn-outline-success">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="course-icon mb-3">
                            <i class="fas fa-code text-warning fa-3x"></i>
                        </div>
                        <h5 class="card-title">Full Stack Development</h5>
                        <p class="card-text text-muted">Complete web development with frontend and backend</p>
                        <a href="/courses/full-stack-development" class="btn btn-outline-warning">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Ready to Start Your Journey?</h2>
                <p class="lead mb-0">Join thousands of students who have transformed their careers with R-CAT.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/admission" class="btn btn-light btn-lg">
                    <i class="fas fa-rocket me-2"></i>Apply Now
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 4rem 0;
}

.course-meta {
    font-size: 0.95rem;
}

.underline {
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin-top: 0.5rem;
}

.curriculum-item {
    padding: 1rem;
    border-left: 3px solid #667eea;
    background: rgba(102, 126, 234, 0.05);
    border-radius: 0 8px 8px 0;
    margin-bottom: 1rem;
}

.module-number .badge {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-item {
    padding: 0.5rem 0;
}

.career-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.career-icon {
    background: rgba(102, 126, 234, 0.1);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.course-sidebar .card {
    margin-bottom: 1.5rem;
}

.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.course-icon {
    background: rgba(102, 126, 234, 0.1);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.cta-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .action-buttons {
        text-align: center;
        margin-top: 2rem;
    }
    
    .course-sidebar {
        margin-top: 2rem;
    }
}
</style>

<script>
// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    // Add scroll animation to curriculum items
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateX(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.curriculum-item').forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(item);
    });
    
    // Add animation to career cards
    document.querySelectorAll('.career-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Handle apply now button clicks
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn') && e.target.textContent.includes('Apply Now')) {
        // Track conversion
        if (typeof gtag !== 'undefined') {
            gtag('event', 'course_application_start', {
                'course_name': '<?php echo htmlspecialchars($course['title']); ?>',
                'course_fee': '<?php echo htmlspecialchars($course['fee']); ?>'
            });
        }
    }
});
</script>
