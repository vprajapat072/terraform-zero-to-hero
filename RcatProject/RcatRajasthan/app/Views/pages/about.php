<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="fade-in">About R-CAT Rajasthan</h1>
                    <p class="fade-in">Empowering the future through world-class technical education and skill development programs in Rajasthan.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center fade-in">
                    <img src="/assets/images/about-hero.jpg" alt="R-CAT Campus" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm fade-in">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <h3 class="mt-3">Our Mission</h3>
                        </div>
                        <p class="text-muted text-center"><?= htmlspecialchars($aboutContent['mission']) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm fade-in">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h3 class="mt-3">Our Vision</h3>
                        </div>
                        <p class="text-muted text-center"><?= htmlspecialchars($aboutContent['vision']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section stats-section">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="text-white">R-CAT by the Numbers</h2>
            <p class="text-white-50">Our achievements and impact in technical education</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card fade-in">
                    <span class="stat-number"><?= $aboutContent['established'] ?></span>
                    <span class="stat-label">Established</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card fade-in">
                    <span class="stat-number"><?= $aboutContent['students_trained'] ?></span>
                    <span class="stat-label">Students Trained</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card fade-in">
                    <span class="stat-number"><?= $aboutContent['courses_offered'] ?></span>
                    <span class="stat-label">Courses Offered</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card fade-in">
                    <span class="stat-number"><?= $aboutContent['placement_rate'] ?></span>
                    <span class="stat-label">Placement Rate</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="content-section fade-in">
                    <h2 class="text-center mb-5">Excellence in Technical Education</h2>
                    <p class="lead text-center mb-5">Rajiv Gandhi Centre of Advanced Technology (R-CAT) stands as a beacon of excellence in technical education and skill development in Rajasthan.</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4><i class="bi bi-check-circle text-success me-2"></i>World-Class Infrastructure</h4>
                            <p>State-of-the-art laboratories, modern classrooms, and cutting-edge equipment ensure that students receive hands-on experience with the latest technology.</p>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="bi bi-check-circle text-success me-2"></i>Industry-Relevant Curriculum</h4>
                            <p>Our courses are designed in collaboration with industry experts to ensure graduates are job-ready and meet current market demands.</p>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="bi bi-check-circle text-success me-2"></i>Expert Faculty</h4>
                            <p>Learn from experienced professionals and industry experts who bring real-world knowledge and practical insights to the classroom.</p>
                        </div>
                        <div class="col-md-6">
                            <h4><i class="bi bi-check-circle text-success me-2"></i>Strong Industry Partnerships</h4>
                            <p>Collaborations with leading technology companies provide students with internship opportunities and direct placement pathways.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Team Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Leadership Team</h2>
            <p class="section-subtitle">Meet the visionaries leading R-CAT towards excellence</p>
        </div>
        
        <div class="row">
            <?php foreach ($leadership as $leader): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card team-card border-0 shadow-sm fade-in">
                    <div class="card-body text-center p-4">
                        <div class="team-image mb-3">
                            <img src="<?= htmlspecialchars($leader['image']) ?>" alt="<?= htmlspecialchars($leader['name']) ?>" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h5 class="card-title mb-1"><?= htmlspecialchars($leader['name']) ?></h5>
                        <p class="text-primary fw-bold mb-3"><?= htmlspecialchars($leader['position']) ?></p>
                        <p class="text-muted small"><?= htmlspecialchars($leader['bio']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section class="section">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Key Achievements</h2>
            <p class="section-subtitle">Recognition and awards that showcase our commitment to excellence</p>
        </div>
        
        <div class="row">
            <?php foreach ($achievements as $achievement): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card achievement-card border-0 shadow-sm fade-in">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="achievement-year">
                                <span class="badge bg-primary fs-6"><?= htmlspecialchars($achievement['year']) ?></span>
                            </div>
                            <div class="achievement-content ms-3">
                                <h5 class="card-title"><?= htmlspecialchars($achievement['title']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($achievement['description']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Our Facilities</h2>
            <p class="section-subtitle">State-of-the-art infrastructure supporting world-class education</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="facility-card text-center fade-in">
                    <div class="facility-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h5>Advanced Computer Labs</h5>
                    <p>Modern computers with latest software and high-speed internet connectivity.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="facility-card text-center fade-in">
                    <div class="facility-icon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <h5>Cloud Infrastructure</h5>
                    <p>Access to leading cloud platforms for hands-on learning and practice.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="facility-card text-center fade-in">
                    <div class="facility-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h5>Digital Library</h5>
                    <p>Comprehensive collection of technical books, journals, and online resources.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="facility-card text-center fade-in">
                    <div class="facility-icon">
                        <i class="bi bi-wifi"></i>
                    </div>
                    <h5>Wi-Fi Campus</h5>
                    <p>High-speed wireless internet connectivity throughout the campus.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="values-content fade-in">
                    <h2>Our Core Values</h2>
                    <div class="value-item mb-4">
                        <h5><i class="bi bi-gem text-primary me-2"></i>Excellence</h5>
                        <p>We strive for excellence in everything we do, from curriculum design to student support services.</p>
                    </div>
                    <div class="value-item mb-4">
                        <h5><i class="bi bi-lightbulb text-primary me-2"></i>Innovation</h5>
                        <p>We embrace innovation and continuously update our methods to stay at the forefront of education.</p>
                    </div>
                    <div class="value-item mb-4">
                        <h5><i class="bi bi-people text-primary me-2"></i>Inclusivity</h5>
                        <p>We believe in providing equal opportunities to all students regardless of their background.</p>
                    </div>
                    <div class="value-item mb-4">
                        <h5><i class="bi bi-handshake text-primary me-2"></i>Integrity</h5>
                        <p>We maintain the highest standards of integrity in all our academic and administrative practices.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="values-image fade-in">
                    <img src="/assets/images/values-illustration.svg" alt="Our Values" class="img-fluid">
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
                <h2 class="mb-4 fade-in">Ready to Join the R-CAT Family?</h2>
                <p class="lead mb-4 fade-in">Discover how R-CAT can transform your career and help you achieve your professional goals.</p>
                <div class="fade-in">
                    <a href="/courses" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-book me-2"></i>
                        Explore Courses
                    </a>
                    <a href="/admission" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-person-plus me-2"></i>
                        Apply Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.team-card {
    transition: transform 0.3s ease;
}

.team-card:hover {
    transform: translateY(-5px);
}

.facility-card {
    padding: 2rem;
}

.facility-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
}

.achievement-card {
    border-left: 4px solid var(--primary-color);
}

.value-item h5 {
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.value-item p {
    color: var(--secondary-color);
    margin-bottom: 0;
}
</style>
