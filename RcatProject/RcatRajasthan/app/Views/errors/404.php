<?php
$pageTitle = "Page Not Found - R-CAT Rajasthan";
$pageDescription = "The page you're looking for doesn't exist. Find information about R-CAT Rajasthan courses and programs.";
$pageKeywords = "404, page not found, R-CAT Rajasthan, courses, programs";

ob_start();
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="error-page">
                <div class="error-code">
                    <h1 class="display-1 text-primary fw-bold">404</h1>
                </div>
                
                <div class="error-content">
                    <h2 class="h3 mb-4">Oops! Page Not Found</h2>
                    <p class="lead text-muted mb-5">
                        The page you're looking for doesn't exist or has been moved. 
                        Let's get you back on track with our R-CAT courses and programs.
                    </p>
                    
                    <div class="row mb-5">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="icon-circle bg-primary bg-opacity-10 mb-3">
                                        <i class="fas fa-home text-primary"></i>
                                    </div>
                                    <h5 class="card-title">Go Home</h5>
                                    <p class="card-text text-muted">Return to our homepage</p>
                                    <a href="/" class="btn btn-primary">Home</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="icon-circle bg-success bg-opacity-10 mb-3">
                                        <i class="fas fa-book text-success"></i>
                                    </div>
                                    <h5 class="card-title">Browse Courses</h5>
                                    <p class="card-text text-muted">Explore our programs</p>
                                    <a href="/courses" class="btn btn-success">Courses</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="icon-circle bg-info bg-opacity-10 mb-3">
                                        <i class="fas fa-info-circle text-info"></i>
                                    </div>
                                    <h5 class="card-title">Get Info</h5>
                                    <p class="card-text text-muted">Learn about R-CAT</p>
                                    <a href="/about" class="btn btn-info">About Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="search-section">
                        <h4 class="mb-3">Search for what you need</h4>
                        <form class="d-flex justify-content-center">
                            <div class="input-group" style="max-width: 400px;">
                                <input type="text" class="form-control" placeholder="Search courses, programs..." id="searchInput">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Courses Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h3>Popular Courses</h3>
                <p class="text-muted">Don't miss out on these trending programs</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-primary bg-opacity-10 me-3">
                                <i class="fas fa-cloud text-primary"></i>
                            </div>
                            <h5 class="card-title mb-0">Cloud Computing</h5>
                        </div>
                        <p class="card-text text-muted mb-3">Master cloud technologies with AWS, Azure, and GCP</p>
                        <a href="/courses/cloud-computing" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-success bg-opacity-10 me-3">
                                <i class="fas fa-robot text-success"></i>
                            </div>
                            <h5 class="card-title mb-0">AI & Machine Learning</h5>
                        </div>
                        <p class="card-text text-muted mb-3">Dive into artificial intelligence and ML algorithms</p>
                        <a href="/courses/ai-machine-learning" class="btn btn-outline-success">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-warning bg-opacity-10 me-3">
                                <i class="fas fa-shield-alt text-warning"></i>
                            </div>
                            <h5 class="card-title mb-0">Cybersecurity</h5>
                        </div>
                        <p class="card-text text-muted mb-3">Protect digital assets with advanced security skills</p>
                        <a href="/courses/cybersecurity" class="btn btn-outline-warning">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.error-page {
    padding: 2rem 0;
}

.error-code h1 {
    font-size: 8rem;
    font-weight: 900;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 1.5rem;
}

.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

@media (max-width: 768px) {
    .error-code h1 {
        font-size: 5rem;
    }
}

.search-section {
    margin-top: 3rem;
    padding: 2rem;
    background: rgba(102, 126, 234, 0.05);
    border-radius: 15px;
}

.input-group .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
</style>

<script>
// Simple search functionality
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const searchTerm = this.value.toLowerCase();
        
        // Simple search redirect based on common terms
        if (searchTerm.includes('course') || searchTerm.includes('program')) {
            window.location.href = '/courses';
        } else if (searchTerm.includes('admission') || searchTerm.includes('apply')) {
            window.location.href = '/admission';
        } else if (searchTerm.includes('about') || searchTerm.includes('info')) {
            window.location.href = '/about';
        } else if (searchTerm.includes('blog') || searchTerm.includes('news')) {
            window.location.href = '/blog';
        } else {
            window.location.href = '/courses';
        }
    }
});

// Add animation on page load
document.addEventListener('DOMContentLoaded', function() {
    const errorPage = document.querySelector('.error-page');
    errorPage.style.opacity = '0';
    errorPage.style.transform = 'translateY(30px)';
    
    setTimeout(() => {
        errorPage.style.transition = 'all 0.8s ease';
        errorPage.style.opacity = '1';
        errorPage.style.transform = 'translateY(0)';
    }, 100);
});
</script>

<?php
$content = ob_get_clean();
include 'app/Views/layouts/main.php';
?>
