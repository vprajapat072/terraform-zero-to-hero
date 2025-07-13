<!-- Hero Section -->
<section class="hero-section" style="min-height: 40vh; padding: 60px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <h1 class="fade-in">All Courses</h1>
                    <p class="fade-in">Explore our comprehensive range of industry-focused courses designed to accelerate your career growth.</p>
                    
                    <!-- Search and Filter -->
                    <div class="course-search-filter mt-4 fade-in">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input" placeholder="Search courses..." id="courseSearch">
                                    <button class="btn btn-outline-light" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Categories Filter -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="course-filters text-center fade-in">
                    <button class="btn btn-outline-primary filter-btn active me-2 mb-2" data-filter="all">
                        <i class="bi bi-grid me-1"></i>
                        All Courses
                    </button>
                    <?php foreach ($categories as $category): ?>
                    <button class="btn btn-outline-primary filter-btn me-2 mb-2" data-filter="<?= htmlspecialchars($category['slug']) ?>">
                        <i class="bi bi-tag me-1"></i>
                        <?= htmlspecialchars($category['name']) ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses Section -->
<section class="section">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Featured Courses</h2>
            <p class="section-subtitle">Our most popular and high-demand courses</p>
        </div>
        
        <div class="row">
            <?php foreach ($featuredCourses as $course): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card course-card fade-in featured-course" data-category="<?= htmlspecialchars($course['category_slug']) ?>">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill me-1"></i>
                                Featured
                            </span>
                            <span class="badge bg-light text-dark">
                                <?= htmlspecialchars($course['category_name']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($course['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($course['short_description']) ?></p>
                        <div class="course-meta">
                            <div class="course-duration">
                                <i class="bi bi-clock me-1"></i>
                                <?= htmlspecialchars($course['duration']) ?>
                            </div>
                            <div class="course-fee">
                                <i class="bi bi-currency-rupee me-1"></i>
                                <?= htmlspecialchars($course['fee']) ?>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <a href="/courses/<?= htmlspecialchars($course['slug']) ?>" class="btn btn-primary btn-sm flex-grow-1">
                                <i class="bi bi-arrow-right me-1"></i>
                                View Details
                            </a>
                            <button class="btn btn-outline-primary btn-sm compare-btn" data-course-id="<?= $course['id'] ?>" data-course-name="<?= htmlspecialchars($course['name']) ?>">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- All Courses Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>All Available Courses</h2>
            <p class="section-subtitle">Choose from our comprehensive catalog of professional courses</p>
        </div>
        
        <div class="row course-grid">
            <?php foreach ($courses as $course): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card course-card fade-in" data-category="<?= htmlspecialchars($course['category_slug']) ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-secondary">
                                <?= htmlspecialchars($course['category_name']) ?>
                            </span>
                            <?php if ($course['is_featured']): ?>
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill me-1"></i>
                                Featured
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <h5 class="card-title"><?= htmlspecialchars($course['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($course['short_description']) ?></p>
                        
                        <div class="course-details mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        Duration: <?= htmlspecialchars($course['duration']) ?>
                                    </small>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="bi bi-currency-rupee me-1"></i>
                                        Fee: <?= htmlspecialchars($course['fee']) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="course-actions d-flex gap-2">
                            <a href="/courses/<?= htmlspecialchars($course['slug']) ?>" class="btn btn-primary btn-sm flex-grow-1">
                                <i class="bi bi-info-circle me-1"></i>
                                Learn More
                            </a>
                            <button class="btn btn-outline-primary btn-sm compare-btn" data-course-id="<?= $course['id'] ?>" data-course-name="<?= htmlspecialchars($course['name']) ?>" data-bs-toggle="tooltip" title="Add to Compare">
                                <i class="bi bi-plus"></i>
                            </button>
                            <button class="btn btn-outline-success btn-sm wishlist-btn" data-course-id="<?= $course['id'] ?>" data-bs-toggle="tooltip" title="Add to Wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Load More Button -->
        <div class="text-center mt-4">
            <button class="btn btn-outline-primary" id="loadMoreCourses" style="display: none;">
                <i class="bi bi-arrow-down me-2"></i>
                Load More Courses
            </button>
        </div>
    </div>
</section>

<!-- Course Comparison Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="course-comparison-info fade-in">
                    <h3>Not Sure Which Course to Choose?</h3>
                    <p class="lead">Use our course comparison tool to find the perfect match for your career goals.</p>
                    
                    <div class="comparison-features">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="bi bi-arrow-left-right text-primary" style="font-size: 2rem;"></i>
                                    <h5>Compare Courses</h5>
                                    <p>Side-by-side comparison of curriculum, duration, and fees</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="bi bi-graph-up text-success" style="font-size: 2rem;"></i>
                                    <h5>Career Prospects</h5>
                                    <p>Learn about job opportunities and salary expectations</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="bi bi-chat-dots text-info" style="font-size: 2rem;"></i>
                                    <h5>Expert Guidance</h5>
                                    <p>Get personalized course recommendations from our counselors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="/courses/compare" class="btn btn-primary btn-lg me-3">
                            <i class="bi bi-arrow-left-right me-2"></i>
                            Compare Courses
                        </a>
                        <a href="/contact" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>
                            Get Guidance
                        </a>
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
            <h2>Frequently Asked Questions</h2>
            <p class="section-subtitle">Common questions about our courses</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>Are the courses industry-recognized?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, all our courses are designed in collaboration with industry partners and provide government-recognized certifications that are valued by employers.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>What is the class schedule like?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>We offer flexible schedules including weekday, weekend, and evening batches to accommodate working professionals and students.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>Do you provide placement assistance?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, we have a dedicated placement cell that works with 500+ industry partners to provide job opportunities for our graduates.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h5>Are there any prerequisites for enrollment?</h5>
                        </div>
                        <div class="faq-answer">
                            <p>Prerequisites vary by course. Most courses require a basic educational qualification, while some advanced courses may have specific requirements.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-color), #0056b3); color: white;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4 fade-in">Ready to Transform Your Career?</h2>
                <p class="lead mb-4 fade-in">Join thousands of students who have successfully launched their careers with R-CAT's industry-focused courses.</p>
                <div class="fade-in">
                    <a href="/admission" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-person-plus me-2"></i>
                        Apply Now
                    </a>
                    <a href="/contact" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-chat-dots me-2"></i>
                        Get Counseling
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Compare Widget -->
<div class="compare-widget">
    <div class="card">
        <div class="card-body text-center">
            <h6 class="card-title">
                <i class="bi bi-arrow-left-right me-1"></i>
                Compare Courses
            </h6>
            <p class="card-text">
                <span class="compare-count">0</span> courses selected
            </p>
            <a href="/courses/compare" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left-right me-1"></i>
                Compare
            </a>
            <button class="btn btn-outline-secondary btn-sm ms-1" id="clearCompare">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>
</div>

<style>
.featured-course {
    border: 2px solid #ffc107;
    box-shadow: 0 4px 8px rgba(255, 193, 7, 0.2);
}

.course-search-filter .form-control {
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.course-search-filter .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.course-search-filter .form-control:focus {
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.2);
}

.course-filters .filter-btn {
    border: 2px solid var(--primary-color);
    transition: all 0.3s ease;
}

.course-filters .filter-btn.active,
.course-filters .filter-btn:hover {
    background: var(--primary-color);
    color: white;
}

.course-grid .course-card {
    transition: all 0.3s ease;
}

.course-grid .course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.feature-item {
    padding: 1.5rem;
}

.feature-item i {
    margin-bottom: 1rem;
}

.feature-item h5 {
    margin-bottom: 0.5rem;
    color: var(--dark-color);
}

.feature-item p {
    color: var(--secondary-color);
    margin-bottom: 0;
}

.course-comparison-info {
    background: white;
    border-radius: 15px;
    padding: 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.comparison-features {
    margin: 2rem 0;
}

@media (max-width: 768px) {
    .course-search-filter .col-md-6 {
        margin-bottom: 1rem;
    }
    
    .course-filters .filter-btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    
    .course-comparison-info {
        padding: 2rem 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Course search functionality
    const searchInput = document.getElementById('courseSearch');
    const courseCards = document.querySelectorAll('.course-card');
    
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        
        courseCards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('.card-text').textContent.toLowerCase();
            
            if (title.includes(query) || description.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Wishlist functionality
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    wishlistButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const courseId = this.dataset.courseId;
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('bi-heart')) {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
                this.classList.remove('btn-outline-success');
                this.classList.add('btn-success');
                // Add to wishlist logic here
            } else {
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
                this.classList.remove('btn-success');
                this.classList.add('btn-outline-success');
                // Remove from wishlist logic here
            }
        });
    });
    
    // Clear compare list
    const clearCompareBtn = document.getElementById('clearCompare');
    if (clearCompareBtn) {
        clearCompareBtn.addEventListener('click', function() {
            localStorage.removeItem('compareList');
            document.querySelector('.compare-count').textContent = '0';
            document.querySelector('.compare-widget').style.display = 'none';
            
            // Reset all compare buttons
            document.querySelectorAll('.compare-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.innerHTML = '<i class="bi bi-plus"></i>';
            });
        });
    }
});
</script>
