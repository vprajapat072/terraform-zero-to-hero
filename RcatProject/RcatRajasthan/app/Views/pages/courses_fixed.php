<!-- JSON-LD Schema for Course Catalog -->
<?php if (isset($schema_markup)): ?>
<script type="application/ld+json">
<?= $schema_markup ?>
</script>
<?php endif; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <h1 class="display-4 fade-in">Professional IT Training Courses</h1>
                    <p class="lead fade-in">Explore our comprehensive range of industry-focused courses designed to accelerate your career growth in technology.</p>
                    
                    <!-- Search and Filter -->
                    <div class="course-search-filter mt-4 fade-in">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-group input-group-lg">
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
                    <?php if (isset($categories) && is_array($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                    <button class="btn btn-outline-primary filter-btn me-2 mb-2" data-filter="<?= htmlspecialchars($category['slug']) ?>">
                        <i class="bi bi-tag me-1"></i>
                        <?= htmlspecialchars($category['name']) ?>
                    </button>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses Section -->
<section class="section">
    <div class="container">
        <div class="section-title text-center fade-in">
            <h2 class="h1 mb-3">Featured Courses</h2>
            <p class="lead text-muted mb-5">Our most popular and high-demand courses with industry certifications</p>
        </div>
        
        <div class="row course-grid">
            <?php if (isset($featuredCourses) && is_array($featuredCourses)): ?>
            <?php foreach ($featuredCourses as $course): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card course-card h-100 fade-in featured-course" data-category="<?= htmlspecialchars($course['category_slug'] ?? 'general') ?>">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill me-1"></i>
                                Featured
                            </span>
                            <span class="badge bg-light text-dark">
                                <?= htmlspecialchars($course['category_name'] ?? 'General') ?>
                            </span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($course['title'] ?? $course['name']) ?></h5>
                        <p class="card-text flex-grow-1"><?= htmlspecialchars($course['short_description']) ?></p>
                        <div class="course-meta mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        Duration
                                    </small>
                                    <div class="fw-bold"><?= htmlspecialchars($course['duration']) ?></div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="bi bi-currency-rupee me-1"></i>
                                        Fee
                                    </small>
                                    <div class="fw-bold text-success"><?= htmlspecialchars($course['fees'] ?? $course['fee']) ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-auto d-flex gap-2">
                            <a href="/courses/<?= htmlspecialchars($course['slug']) ?>" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-arrow-right me-1"></i>
                                View Details
                            </a>
                            <button class="btn btn-outline-primary compare-btn" data-course-id="<?= $course['id'] ?>" data-course-name="<?= htmlspecialchars($course['title'] ?? $course['name']) ?>">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- All Courses Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title text-center fade-in">
            <h2 class="h1 mb-3">All Available Courses</h2>
            <p class="lead text-muted mb-5">Complete list of professional courses with detailed curriculum</p>
        </div>
        
        <div class="row course-grid" id="allCoursesGrid">
            <?php if (isset($allCourses) && is_array($allCourses)): ?>
            <?php foreach ($allCourses as $course): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card course-card h-100 fade-in" data-category="<?= htmlspecialchars($course['category_slug'] ?? 'general') ?>">
                    <div class="card-header <?= isset($course['is_featured']) && $course['is_featured'] ? 'bg-warning' : 'bg-primary' ?> text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-dark">
                                <?= htmlspecialchars($course['category_name'] ?? 'General') ?>
                            </span>
                            <?php if (isset($course['is_featured']) && $course['is_featured']): ?>
                            <span class="badge bg-primary">
                                <i class="bi bi-star-fill me-1"></i>
                                Popular
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($course['title'] ?? $course['name']) ?></h5>
                        <p class="card-text flex-grow-1"><?= htmlspecialchars($course['short_description']) ?></p>
                        
                        <!-- Course Details -->
                        <div class="course-details mb-3">
                            <div class="row g-2">
                                <div class="col-6">
                                    <small class="text-muted d-block">Duration</small>
                                    <span class="fw-bold"><?= htmlspecialchars($course['duration']) ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Fee</small>
                                    <span class="fw-bold text-success"><?= htmlspecialchars($course['fees'] ?? $course['fee']) ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Mode</small>
                                    <span class="fw-bold"><?= htmlspecialchars($course['mode'] ?? 'Classroom') ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Level</small>
                                    <span class="fw-bold"><?= htmlspecialchars($course['level'] ?? 'Beginner') ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-auto d-flex gap-2">
                            <a href="/courses/<?= htmlspecialchars($course['slug']) ?>" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-info-circle me-1"></i>
                                View Details
                            </a>
                            <button class="btn btn-outline-primary compare-btn" data-course-id="<?= $course['id'] ?>" data-course-name="<?= htmlspecialchars($course['title'] ?? $course['name']) ?>">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-book text-muted" style="font-size: 4rem;"></i>
                <h3 class="mt-3">No Courses Available</h3>
                <p class="text-muted">We're working on adding more courses. Please check back soon!</p>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Load More Button -->
        <div class="text-center mt-4 fade-in">
            <button class="btn btn-outline-primary" id="loadMoreCourses" style="display: none;">
                <i class="bi bi-arrow-down-circle me-1"></i>
                Load More Courses
            </button>
        </div>
    </div>
</section>

<!-- Course Comparison Widget -->
<div class="compare-widget position-fixed bottom-0 end-0 m-3 p-3 bg-primary text-white rounded shadow" style="display: none; z-index: 1000;">
    <div class="d-flex align-items-center">
        <div class="me-3">
            <strong>Compare Courses</strong>
            <div class="compare-count">0 selected</div>
        </div>
        <button class="btn btn-sm btn-light me-2" onclick="showComparison()">
            <i class="bi bi-eye"></i>
            Compare
        </button>
        <button class="btn btn-sm btn-outline-light" onclick="clearComparison()">
            <i class="bi bi-x"></i>
        </button>
    </div>
</div>

<!-- Why Choose Our Courses Section -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="course-comparison-info">
                    <h2 class="h1 mb-4">Why Choose R-CAT Courses?</h2>
                    <p class="lead mb-4">We provide industry-leading training with hands-on experience and guaranteed placement assistance.</p>
                    
                    <div class="comparison-features">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="feature-item text-center">
                                    <i class="bi bi-award text-primary" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3">Industry Certified</h5>
                                    <p>Get recognized certifications from leading technology companies.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-item text-center">
                                    <i class="bi bi-people text-success" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3">Expert Instructors</h5>
                                    <p>Learn from industry professionals with real-world experience.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-item text-center">
                                    <i class="bi bi-laptop text-info" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3">Hands-on Projects</h5>
                                    <p>Build real projects and create a portfolio that stands out.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-item text-center">
                                    <i class="bi bi-briefcase text-warning" style="font-size: 2.5rem;"></i>
                                    <h5 class="mt-3">Placement Support</h5>
                                    <p>Get job placement assistance with our industry connections.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="/admission" class="btn btn-primary btn-lg me-3">
                            <i class="bi bi-clipboard-check me-2"></i>
                            Apply Now
                        </a>
                        <a href="/contact" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>
                            Get Info
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="/assets/images/course-benefits.svg" alt="Course Benefits" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="section" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <h2 class="h1 mb-3">Ready to Start Your Tech Career?</h2>
                    <p class="lead mb-4">Join thousands of successful graduates who have transformed their careers with R-CAT training programs.</p>
                    
                    <div class="stats-row row text-center mb-4">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-item">
                                <h3 class="display-6 fw-bold">5000+</h3>
                                <p class="mb-0">Students Trained</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-item">
                                <h3 class="display-6 fw-bold">95%</h3>
                                <p class="mb-0">Placement Rate</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-item">
                                <h3 class="display-6 fw-bold">200+</h3>
                                <p class="mb-0">Hiring Partners</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-item">
                                <h3 class="display-6 fw-bold">15+</h3>
                                <p class="mb-0">Years Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="cta-buttons">
                    <a href="/admission" class="btn btn-light btn-lg mb-3 d-block">
                        <i class="bi bi-calendar-check me-2"></i>
                        Enroll Today
                    </a>
                    <a href="/contact" class="btn btn-outline-light btn-lg d-block">
                        <i class="bi bi-telephone me-2"></i>
                        Call for Info
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
.hero-section {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    padding: 100px 0;
    min-height: 60vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M20 20c0 11.046-8.954 20-20 20v-1c10.493 0 19-8.507 19-19s-8.507-19-19-19v-1c11.046 0 20 8.954 20 20z'/%3E%3C/g%3E%3C/svg%3E") repeat;
}

.section {
    padding: 4rem 0;
}

.section-title h2 {
    color: #333;
    font-weight: 700;
}

.featured-course {
    border: 2px solid #ffc107;
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.2);
    transform: scale(1.02);
}

.course-search-filter .form-control {
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 1.1rem;
    padding: 0.75rem 1.5rem;
}

.course-search-filter .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.course-search-filter .form-control:focus {
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.course-filters .filter-btn {
    border: 2px solid #007bff;
    transition: all 0.3s ease;
    font-weight: 500;
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
}

.course-filters .filter-btn.active,
.course-filters .filter-btn:hover {
    background: #007bff;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.course-grid .course-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
}

.course-grid .course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.course-card .card-header {
    border-radius: 15px 15px 0 0 !important;
    padding: 1rem 1.5rem;
    border: none;
}

.course-card .card-body {
    padding: 1.5rem;
}

.course-details {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1rem;
}

.feature-item {
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-item i {
    margin-bottom: 1rem;
}

.feature-item h5 {
    margin-bottom: 0.5rem;
    color: #333;
    font-weight: 600;
}

.feature-item p {
    color: #6c757d;
    margin-bottom: 0;
}

.course-comparison-info {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.compare-widget {
    min-width: 250px;
    border-radius: 15px !important;
}

.compare-count {
    font-size: 0.9rem;
    opacity: 0.9;
}

.stats-row .stat-item h3 {
    color: white;
    margin-bottom: 0.5rem;
}

.stats-row .stat-item p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
}

.fade-in {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0;
        min-height: 50vh;
    }
    
    .section {
        padding: 2.5rem 0;
    }
    
    .course-search-filter .input-group-lg .form-control {
        font-size: 1rem;
    }
    
    .course-filters .filter-btn {
        font-size: 0.9rem;
        padding: 0.4rem 1rem;
        margin: 0.2rem;
    }
    
    .course-comparison-info {
        padding: 2rem 1rem;
    }
    
    .compare-widget {
        left: 50% !important;
        transform: translateX(-50%);
        right: auto !important;
        margin: 1rem !important;
        min-width: 200px;
    }
    
    .stats-row .stat-item h3 {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .hero-section .lead {
        font-size: 1rem;
    }
    
    .section-title h2 {
        font-size: 1.75rem;
    }
    
    .cta-buttons .btn {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
    }
}
</style>

<!-- Course Functionality JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Course search functionality
    const searchInput = document.getElementById('courseSearch');
    const courseCards = document.querySelectorAll('.course-card');
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    let selectedCourses = [];
    
    // Search courses
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            courseCards.forEach(card => {
                const courseTitle = card.querySelector('.card-title').textContent.toLowerCase();
                const courseDescription = card.querySelector('.card-text').textContent.toLowerCase();
                
                if (searchTerm === '' || courseTitle.includes(searchTerm) || courseDescription.includes(searchTerm)) {
                    card.parentElement.style.display = 'block';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    }
    
    // Filter courses by category
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter courses
            courseCards.forEach(card => {
                const category = card.dataset.category;
                
                if (filter === 'all' || category === filter) {
                    card.parentElement.style.display = 'block';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    });
    
    // Course comparison functionality
    const compareButtons = document.querySelectorAll('.compare-btn');
    const compareWidget = document.querySelector('.compare-widget');
    const compareCount = document.querySelector('.compare-count');
    
    compareButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.dataset.courseId;
            const courseName = this.dataset.courseName;
            
            if (selectedCourses.find(course => course.id === courseId)) {
                // Remove from comparison
                selectedCourses = selectedCourses.filter(course => course.id !== courseId);
                this.classList.remove('btn-primary');
                this.classList.add('btn-outline-primary');
                this.innerHTML = '<i class="bi bi-plus-circle"></i>';
            } else {
                // Add to comparison (max 3)
                if (selectedCourses.length < 3) {
                    selectedCourses.push({id: courseId, name: courseName});
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-primary');
                    this.innerHTML = '<i class="bi bi-check-circle"></i>';
                } else {
                    alert('You can compare maximum 3 courses at a time.');
                    return;
                }
            }
            
            // Update comparison widget
            updateComparisonWidget();
        });
    });
    
    function updateComparisonWidget() {
        if (selectedCourses.length > 0) {
            compareWidget.style.display = 'block';
            compareCount.textContent = `${selectedCourses.length} selected`;
        } else {
            compareWidget.style.display = 'none';
        }
    }
    
    // Show comparison
    window.showComparison = function() {
        if (selectedCourses.length === 0) {
            alert('Please select at least one course to compare.');
            return;
        }
        
        // Redirect to comparison page or show modal
        const courseIds = selectedCourses.map(course => course.id).join(',');
        window.location.href = `/courses/compare?courses=${courseIds}`;
    }
    
    // Clear comparison
    window.clearComparison = function() {
        selectedCourses = [];
        compareButtons.forEach(button => {
            button.classList.remove('btn-primary');
            button.classList.add('btn-outline-primary');
            button.innerHTML = '<i class="bi bi-plus-circle"></i>';
        });
        compareWidget.style.display = 'none';
    }
    
    // Load more functionality (if needed)
    const loadMoreBtn = document.getElementById('loadMoreCourses');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Implementation for loading more courses
            console.log('Loading more courses...');
        });
    }
});
</script>
