<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="fade-in">Transform Your Career with R-CAT Rajasthan</h1>
                    <p class="fade-in">Master cutting-edge technologies with industry-expert training. Join thousands of professionals who have advanced their careers through our comprehensive certification programs in Cloud Computing, AI/ML, Cybersecurity, and more.</p>
                    <div class="hero-cta fade-in">
                        <a href="/courses" class="btn btn-light btn-hero">
                            <i class="bi bi-graduation-cap me-2"></i>
                            Explore Courses
                        </a>
                        <a href="/admission" class="btn btn-outline-light btn-hero">
                            <i class="bi bi-person-check me-2"></i>
                            Start Your Journey
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center fade-in">
                    <img src="/assets/images/hero-illustration.svg" alt="R-CAT Education" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-card fade-in">
                    <span class="stat-number">6+</span>
                    <span class="stat-label">Specialized Courses</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card fade-in">
                    <span class="stat-number">5000+</span>
                    <span class="stat-label">Students Trained</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card fade-in">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">Placement Rate</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card fade-in">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Industry Partners</span>
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
            <p class="section-subtitle">Discover our most popular courses designed to boost your career in the latest technologies</p>
        </div>
        
        <div class="row">
            <?php foreach ($featuredCourses as $course): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card course-card fade-in" data-category="<?= $course['category'] ?>">
                    <div class="card-body">
                        <div class="course-icon mb-3">
                            <i class="bi bi-cpu-fill" style="font-size: 2rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title"><?= htmlspecialchars($course['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($course['description']) ?></p>
                        <div class="course-meta">
                            <div class="course-duration">
                                <i class="bi bi-clock me-1"></i>
                                <?= htmlspecialchars($course['duration']) ?>
                            </div>
                            <div class="course-fee">
                                <?= htmlspecialchars($course['fee']) ?>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="/courses/<?= $course['slug'] ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-arrow-right me-1"></i>
                                Learn More
                            </a>
                            <button class="btn btn-outline-primary btn-sm compare-btn" data-course-id="<?= $course['id'] ?>" data-course-name="<?= htmlspecialchars($course['name']) ?>">
                                <i class="bi bi-plus"></i>
                                Compare
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/courses" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-grid-3x3-gap me-2"></i>
                View All Courses
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Why Choose R-CAT Rajasthan?</h2>
            <p class="section-subtitle">Discover the unique advantages that make R-CAT the preferred choice for skill development</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h5>Industry-Relevant Curriculum</h5>
                    <p>Our courses are designed in collaboration with industry experts to ensure you learn the most current and applicable skills.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <h5>Government Certification</h5>
                    <p>Receive recognized government certifications that are valued by employers across India and internationally.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5>Expert Faculty</h5>
                    <p>Learn from experienced professionals and industry experts who bring real-world knowledge to the classroom.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h5>Hands-on Training</h5>
                    <p>Get practical experience with state-of-the-art labs and equipment to reinforce your learning.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <h5>Job Placement Support</h5>
                    <p>Benefit from our strong industry connections and dedicated placement cell to secure your dream job.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <h5>Affordable Fees</h5>
                    <p>High-quality education at government-subsidized rates, making advanced skills accessible to everyone.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About R-CAT Section -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content fade-in">
                    <h2>About R-CAT Rajasthan</h2>
                    <p class="lead">Rajiv Gandhi Centre of Advanced Technology (R-CAT) is a premier institution dedicated to providing world-class technical education and skill development programs in Rajasthan.</p>
                    <p>Established to bridge the gap between academic knowledge and industry requirements, R-CAT offers cutting-edge courses in emerging technologies like Cloud Computing, Artificial Intelligence, Cybersecurity, and more.</p>
                    <p>With state-of-the-art infrastructure, experienced faculty, and strong industry partnerships, R-CAT has become the preferred destination for students seeking quality technical education at affordable costs.</p>
                    <a href="/about" class="btn btn-primary">
                        <i class="bi bi-info-circle me-2"></i>
                        Learn More About Us
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image fade-in">
                    <img src="/assets/images/about-rcat.jpg" alt="R-CAT Campus" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Blog Posts Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Latest Blog Posts</h2>
            <p class="section-subtitle">Stay updated with the latest trends, career tips, and industry insights</p>
        </div>
        
        <div class="row">
            <?php foreach ($latestPosts as $post): ?>
            <div class="col-lg-6 mb-4">
                <div class="card blog-card fade-in">
                    <div class="card-body">
                        <div class="blog-meta">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?= Utils::formatDate($post['date']) ?>
                        </div>
                        <h5 class="blog-title">
                            <a href="/blog/<?= $post['slug'] ?>" class="text-decoration-none">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h5>
                        <p class="blog-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
                        <a href="/blog/<?= $post['slug'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-arrow-right me-1"></i>
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/blog" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-journal-text me-2"></i>
                View All Posts
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-color), #0056b3); color: white;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4 fade-in">Ready to Start Your Journey?</h2>
                <p class="lead mb-4 fade-in">Join thousands of students who have transformed their careers with R-CAT's industry-focused courses.</p>
                <div class="fade-in">
                    <a href="/admission" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-person-plus me-2"></i>
                        Apply Now
                    </a>
                    <a href="/courses" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-book me-2"></i>
                        Browse Courses
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
            <h6 class="card-title">Compare Courses</h6>
            <p class="card-text">
                <span class="compare-count">0</span> courses selected
            </p>
            <a href="/courses/compare" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left-right me-1"></i>
                Compare
            </a>
        </div>
    </div>
</div>
