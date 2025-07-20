<?php
$schema_markup = $courseSchema;
include 'app/Views/layouts/main.php';

function renderMainContent() {
    global $course, $relatedCourses;
?>

<!-- Course Hero Section -->
<section class="course-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="course-hero-content">
                    <div class="course-meta mb-3">
                        <span class="badge bg-primary"><?= htmlspecialchars($course['category']) ?></span>
                        <span class="badge bg-success">Industry Certified</span>
                        <?php if (isset($course['featured']) && $course['featured']): ?>
                        <span class="badge bg-warning">⭐ Featured</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="course-title display-4 mb-4"><?= htmlspecialchars($course['title']) ?></h1>
                    <p class="course-description lead mb-4"><?= htmlspecialchars($course['short_description']) ?></p>
                    
                    <div class="course-quick-info">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <div class="info-item">
                                    <i class="bi bi-clock text-primary"></i>
                                    <div class="info-content">
                                        <small class="text-muted">Duration</small>
                                        <div class="fw-bold"><?= htmlspecialchars($course['duration']) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="info-item">
                                    <i class="bi bi-currency-rupee text-success"></i>
                                    <div class="info-content">
                                        <small class="text-muted">Fees</small>
                                        <div class="fw-bold"><?= htmlspecialchars($course['fees']) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="info-item">
                                    <i class="bi bi-award text-warning"></i>
                                    <div class="info-content">
                                        <small class="text-muted">Certification</small>
                                        <div class="fw-bold">Industry</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="info-item">
                                    <i class="bi bi-briefcase text-info"></i>
                                    <div class="info-content">
                                        <small class="text-muted">Career Support</small>
                                        <div class="fw-bold">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-enrollment-card">
                    <div class="card shadow-lg border-0">
                        <div class="card-body text-center p-4">
                            <div class="price-section mb-3">
                                <div class="current-price h2 text-primary mb-1"><?= htmlspecialchars($course['fees']) ?></div>
                                <small class="text-muted">One-time payment</small>
                            </div>
                            
                            <div class="enrollment-features mb-4">
                                <div class="feature-item mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <span>Industry Expert Instructors</span>
                                </div>
                                <div class="feature-item mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <span>Hands-on Projects</span>
                                </div>
                                <div class="feature-item mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <span>Placement Assistance</span>
                                </div>
                                <div class="feature-item mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    <span>Industry Certification</span>
                                </div>
                            </div>
                            
                            <div class="enrollment-actions">
                                <a href="/admission" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="bi bi-person-plus me-2"></i>Enroll Now
                                </a>
                                <a href="/contact" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-telephone me-2"></i>Get Info
                                </a>
                            </div>
                            
                            <div class="batch-timing mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <?= htmlspecialchars($course['batch_timing']) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Details Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Course Overview -->
                <div class="course-section mb-5">
                    <h2 class="section-title">Course Overview</h2>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="mb-3"><?= htmlspecialchars($course['short_description']) ?></p>
                            
                            <div class="course-highlights">
                                <h5 class="mb-3">What You'll Learn:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <?php if (isset($course['curriculum']) && !empty($course['curriculum'])): ?>
                                                <?php $allTopics = []; ?>
                                                <?php foreach ($course['curriculum'] as $module => $topics): ?>
                                                    <?php $allTopics = array_merge($allTopics, array_slice($topics, 0, 2)); ?>
                                                <?php endforeach; ?>
                                                <?php foreach (array_slice($allTopics, 0, 4) as $topic): ?>
                                                <li class="mb-2">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    <?= htmlspecialchars($topic) ?>
                                                </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li class="mb-2">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    Industry-standard tools and techniques
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-check-circle text-success me-2"></i>
                                                    Real-world project experience
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="bi bi-check-circle text-success me-2"></i>
                                                Professional certification preparation
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check-circle text-success me-2"></i>
                                                Career guidance and placement support
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Curriculum Section -->
                <?php if (isset($course['curriculum']) && !empty($course['curriculum'])): ?>
                <div class="course-section mb-5">
                    <h2 class="section-title">Curriculum</h2>
                    <div class="curriculum-accordion">
                        <div class="accordion" id="curriculumAccordion">
                            <?php $moduleIndex = 0; ?>
                            <?php foreach ($course['curriculum'] as $moduleName => $topics): ?>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading<?= $moduleIndex ?>">
                                    <button class="accordion-button <?= $moduleIndex > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $moduleIndex ?>" aria-expanded="<?= $moduleIndex === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $moduleIndex ?>">
                                        <span class="module-number me-3"><?= str_pad($moduleIndex + 1, 2, '0', STR_PAD_LEFT) ?></span>
                                        <span class="module-title"><?= htmlspecialchars($moduleName) ?></span>
                                        <span class="module-count ms-auto me-3"><?= count($topics) ?> topics</span>
                                    </button>
                                </h3>
                                <div id="collapse<?= $moduleIndex ?>" class="accordion-collapse collapse <?= $moduleIndex === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $moduleIndex ?>" data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        <ul class="topic-list">
                                            <?php foreach ($topics as $topic): ?>
                                            <li class="topic-item">
                                                <i class="bi bi-play-circle text-primary me-2"></i>
                                                <?= htmlspecialchars($topic) ?>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php $moduleIndex++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Projects Section -->
                <?php if (isset($course['projects']) && !empty($course['projects'])): ?>
                <div class="course-section mb-5">
                    <h2 class="section-title">Hands-on Projects</h2>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="mb-4">Build real-world projects that will enhance your portfolio and demonstrate your skills to potential employers.</p>
                            <div class="row">
                                <?php foreach ($course['projects'] as $index => $project): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="project-item">
                                        <div class="project-number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></div>
                                        <div class="project-content">
                                            <h6 class="project-title"><?= htmlspecialchars($project) ?></h6>
                                            <small class="text-muted">Portfolio Project</small>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Call to Action Section -->
                <div class="course-section mb-5">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body text-center p-5">
                            <h3 class="mb-3">Ready to Start Your Journey?</h3>
                            <p class="lead mb-4">Transform your career with industry-relevant skills and expert guidance</p>
                            <div class="cta-buttons">
                                <a href="/admission" class="btn btn-light btn-lg me-3">
                                    <i class="bi bi-person-plus me-2"></i>Enroll Now
                                </a>
                                <a href="/contact" class="btn btn-outline-light btn-lg">
                                    <i class="bi bi-download me-2"></i>Download Syllabus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="course-sidebar">
                    <!-- Course Info -->
                    <div class="sidebar-section mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Course Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="course-detail-item mb-3">
                                    <div class="detail-label text-muted small">Duration</div>
                                    <div class="detail-value fw-bold"><?= htmlspecialchars($course['duration']) ?></div>
                                </div>
                                <div class="course-detail-item mb-3">
                                    <div class="detail-label text-muted small">Batch Timing</div>
                                    <div class="detail-value"><?= htmlspecialchars($course['batch_timing']) ?></div>
                                </div>
                                <div class="course-detail-item mb-3">
                                    <div class="detail-label text-muted small">Certification</div>
                                    <div class="detail-value"><?= htmlspecialchars($course['certification']) ?></div>
                                </div>
                                <div class="course-detail-item mb-3">
                                    <div class="detail-label text-muted small">Partnership</div>
                                    <div class="detail-value"><?= htmlspecialchars($course['partnership']) ?></div>
                                </div>
                                <div class="course-detail-item mb-3">
                                    <div class="detail-label text-muted small">Eligibility</div>
                                    <div class="detail-value"><?= htmlspecialchars($course['eligibility']) ?></div>
                                </div>
                                <div class="course-detail-item">
                                    <div class="detail-label text-muted small">Career Prospects</div>
                                    <div class="detail-value text-success fw-bold"><?= htmlspecialchars($course['career_prospects']) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="sidebar-section mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Need Help?</h5>
                            </div>
                            <div class="card-body text-center">
                                <p class="mb-3">Have questions about this course? Our counselors are here to help!</p>
                                <a href="/contact" class="btn btn-success w-100 mb-2">
                                    <i class="bi bi-telephone me-2"></i>Call Now
                                </a>
                                <a href="/admission" class="btn btn-outline-success w-100">
                                    <i class="bi bi-chat-dots me-2"></i>Chat with Expert
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Related Courses -->
                    <?php if (!empty($relatedCourses)): ?>
                    <div class="sidebar-section">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Related Courses</h5>
                            </div>
                            <div class="card-body p-0">
                                <?php foreach ($relatedCourses as $relatedCourse): ?>
                                <div class="related-course-item p-3 border-bottom">
                                    <h6 class="mb-2">
                                        <a href="/courses/<?= htmlspecialchars($relatedCourse['slug']) ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($relatedCourse['title']) ?>
                                        </a>
                                    </h6>
                                    <div class="course-meta small text-muted">
                                        <span class="me-3">
                                            <i class="bi bi-clock me-1"></i><?= htmlspecialchars($relatedCourse['duration']) ?>
                                        </span>
                                        <span class="text-success fw-bold"><?= htmlspecialchars($relatedCourse['fees']) ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.course-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0;
    color: white;
}

.course-hero-section .badge {
    font-size: 0.9rem;
    margin-right: 8px;
}

.info-item {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 10px;
}

.info-item i {
    font-size: 1.5rem;
    margin-right: 12px;
}

.course-enrollment-card {
    position: sticky;
    top: 20px;
}

.section-title {
    color: var(--primary-color);
    border-bottom: 3px solid var(--primary-color);
    padding-bottom: 10px;
    margin-bottom: 30px;
}

.curriculum-accordion .accordion-button {
    font-weight: 600;
    padding: 20px;
}

.module-number {
    background: var(--primary-color);
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.topic-list {
    list-style: none;
    padding: 0;
}

.topic-item {
    padding: 8px 0;
    border-bottom: 1px solid #f1f3f4;
}

.topic-item:last-child {
    border-bottom: none;
}

.project-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 15px;
}

.project-number {
    background: var(--primary-color);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 15px;
}

.course-sidebar {
    position: sticky;
    top: 20px;
}

.related-course-item:last-child {
    border-bottom: none !important;
}

@media (max-width: 768px) {
    .course-hero-section {
        padding: 40px 0;
    }
    
    .course-enrollment-card {
        margin-top: 30px;
        position: static;
    }
    
    .course-sidebar {
        position: static;
        margin-top: 30px;
    }
}
</style>

<?php
}
?>
