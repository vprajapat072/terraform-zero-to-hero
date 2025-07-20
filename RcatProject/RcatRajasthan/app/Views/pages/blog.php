<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <h1 class="display-4 fade-in">R-CAT Blog</h1>
                    <p class="lead fade-in">Stay updated with the latest career guidance, industry trends, and success stories from R-CAT Rajasthan.</p>
                    
                    <!-- Search Bar -->
                    <div class="blog-search mt-4 fade-in">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control search-input" placeholder="Search articles..." id="blogSearch">
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

<!-- Blog Categories Filter -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-filters text-center fade-in">
                    <button class="btn btn-outline-primary filter-btn active me-2 mb-2" data-filter="all">
                        <i class="bi bi-grid me-1"></i>
                        All Posts
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

<!-- Featured Posts Section -->
<section class="section">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Featured Articles</h2>
            <p class="section-subtitle">Our most popular and trending articles</p>
        </div>
        
        <div class="row">
            <?php foreach ($featuredPosts as $post): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card blog-card featured-post fade-in" data-category="<?= htmlspecialchars($post['category_slug']) ?>">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-danger text-white">
                                <i class="bi bi-fire me-1"></i>
                                Featured
                            </span>
                            <span class="badge bg-primary">
                                <?= htmlspecialchars($post['category_name']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="blog-meta mb-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                <?= date('M d, Y', strtotime($post['published_at'])) ?>
                                <span class="mx-2">•</span>
                                <i class="bi bi-person me-1"></i>
                                <?= htmlspecialchars($post['author_name']) ?>
                                <span class="mx-2">•</span>
                                <i class="bi bi-tag me-1"></i>
                                <?= htmlspecialchars($post['category_name']) ?>
                            </small>
                        </div>
                        <h5 class="card-title">
                            <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h5>
                        <p class="card-text"><?= htmlspecialchars($post['excerpt']) ?></p>
                        <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-right me-1"></i>
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- All Posts Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Latest Articles</h2>
            <p class="section-subtitle">Stay informed with our latest content</p>
        </div>
        
        <div class="row blog-grid">
            <?php foreach ($posts as $post): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card blog-card fade-in" data-category="<?= htmlspecialchars($post['category_slug']) ?>">
                    <div class="card-body">
                        <div class="blog-meta mb-3">
                            <span class="badge bg-<?= $post['category_slug'] === 'career-guidance' ? 'success' : ($post['category_slug'] === 'industry-trends' ? 'info' : ($post['category_slug'] === 'success-stories' ? 'warning' : 'secondary')) ?>">
                                <?= htmlspecialchars($post['category_name']) ?>
                            </span>
                            <small class="text-muted ms-2">
                                <i class="bi bi-clock me-1"></i>
                                <?= date('M d, Y', strtotime($post['published_at'])) ?>
                            </small>
                        </div>
                        
                        <h5 class="card-title">
                            <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h5>
                        <p class="card-text"><?= htmlspecialchars($post['excerpt']) ?></p>
                        
                        <div class="blog-footer d-flex justify-content-between align-items-center">
                            <div class="blog-author">
                                <small class="text-muted">
                                    <i class="bi bi-person me-1"></i>
                                    <?= htmlspecialchars($post['author_name']) ?>
                                </small>
                            </div>
                            <div class="blog-stats">
                                <small class="text-muted">
                                    <i class="bi bi-bookmark me-1"></i>
                                    Article
                                </small>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-book me-1"></i>
                                Read Article
                            </a>
                            <button class="btn btn-outline-success btn-sm ms-2" onclick="sharePost('<?= htmlspecialchars($post['title']) ?>', 'https://rcatrajasthan.com/blog/<?= htmlspecialchars($post['slug']) ?>')">>
                                <i class="bi bi-share"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Load More Button -->
        <div class="text-center mt-4">
            <button class="btn btn-outline-primary" id="loadMorePosts">
                <i class="bi bi-arrow-down me-2"></i>
                Load More Articles
            </button>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="newsletter-section text-center fade-in">
                    <div class="newsletter-card">
                        <h3>Subscribe to Our Newsletter</h3>
                        <p class="lead">Get the latest articles, career tips, and course updates delivered directly to your inbox.</p>
                        
                        <form class="newsletter-form mt-4" id="newsletterForm">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Enter your email" required>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-envelope me-1"></i>
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                We respect your privacy. Unsubscribe at any time.
                            </small>
                        </form>
                        
                        <div class="newsletter-benefits mt-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class="bi bi-envelope-check text-primary"></i>
                                    <h6>Weekly Updates</h6>
                                    <p>Get fresh content every week</p>
                                </div>
                                <div class="col-md-4">
                                    <i class="bi bi-mortarboard text-success"></i>
                                    <h6>Career Tips</h6>
                                    <p>Expert advice for your career</p>
                                </div>
                                <div class="col-md-4">
                                    <i class="bi bi-bell text-warning"></i>
                                    <h6>Course Updates</h6>
                                    <p>Be first to know about new courses</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Categories Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Popular Categories</h2>
            <p class="section-subtitle">Explore articles by category</p>
        </div>
        
        <div class="row">
            <?php foreach ($categories as $category): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card category-card fade-in">
                    <div class="card-body text-center">
                        <div class="category-icon mb-3">
                            <i class="bi bi-<?= $category['slug'] === 'career-guidance' ? 'compass' : ($category['slug'] === 'industry-trends' ? 'graph-up' : ($category['slug'] === 'success-stories' ? 'trophy' : ($category['slug'] === 'technology-news' ? 'cpu' : 'book'))) ?>"></i>
                        </div>
                        <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                        <p class="card-text">
                            <?php
                            $descriptions = [
                                'career-guidance' => 'Professional development tips and career advice',
                                'industry-trends' => 'Latest trends and insights from the tech industry',
                                'success-stories' => 'Inspiring stories from our successful alumni',
                                'technology-news' => 'Breaking news and updates from the tech world',
                                'course-updates' => 'Latest updates and announcements about our courses'
                            ];
                            echo htmlspecialchars($descriptions[$category['slug']] ?? 'Explore articles in this category');
                            ?>
                        </p>
                        <a href="/blog/category/<?= htmlspecialchars($category['slug']) ?>" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-right me-1"></i>
                            View Articles
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-color), #0056b3); color: white;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4 fade-in">Ready to Start Your Learning Journey?</h2>
                <p class="lead mb-4 fade-in">Join our community of learners and professionals. Explore our courses and transform your career.</p>
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

.blog-search .form-control {
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: 25px;
    padding: 12px 20px;
}

.blog-search .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.blog-search .form-control:focus {
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.2);
}

.blog-search .btn {
    border-radius: 25px;
    padding: 12px 20px;
}

.blog-filters .filter-btn {
    border: 2px solid #007bff;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.blog-filters .filter-btn.active,
.blog-filters .filter-btn:hover {
    background: #007bff;
    color: white;
}

.featured-post {
    border: 2px solid #ffc107;
    box-shadow: 0 4px 8px rgba(255, 193, 7, 0.2);
}

.blog-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.blog-card .card-title a {
    color: #212529;
    transition: color 0.3s ease;
}

.blog-card .card-title a:hover {
    color: #007bff;
}

.blog-meta {
    font-size: 0.9rem;
}

.blog-footer {
    border-top: 1px solid #e9ecef;
    padding-top: 1rem;
    margin-top: 1rem;
}

.newsletter-section {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 3rem;
}

.newsletter-card h3 {
    color: var(--dark-color);
    margin-bottom: 1rem;
}

.newsletter-benefits {
    text-align: center;
}

.newsletter-benefits i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.newsletter-benefits h6 {
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.newsletter-benefits p {
    color: var(--secondary-color);
    font-size: 0.9rem;
    margin-bottom: 0;
}

.category-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.category-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .newsletter-section {
        padding: 2rem 1rem;
    }
    
    .blog-filters .filter-btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    
    .newsletter-benefits {
        margin-top: 2rem;
    }
    
    .newsletter-benefits .col-md-4 {
        margin-bottom: 1.5rem;
    }
}

.share-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    padding: 2rem;
    z-index: 9999;
    min-width: 300px;
}

.share-popup h5 {
    margin-bottom: 1rem;
    text-align: center;
}

.share-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.share-buttons .btn {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-backdrop {
    background: rgba(0, 0, 0, 0.5);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Blog search functionality
    const searchInput = document.getElementById('blogSearch');
    const blogCards = document.querySelectorAll('.blog-card');
    
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        
        blogCards.forEach(card => {
            const title = card.querySelector('.card-title a').textContent.toLowerCase();
            const excerpt = card.querySelector('.card-text').textContent.toLowerCase();
            
            if (title.includes(query) || excerpt.includes(query)) {
                card.parentElement.style.display = 'block';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
    
    // Newsletter form submission
    const newsletterForm = document.getElementById('newsletterForm');
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        if (email) {
            // Show success message
            const successAlert = document.createElement('div');
            successAlert.className = 'alert alert-success mt-3';
            successAlert.innerHTML = '<i class="bi bi-check-circle me-2"></i>Thank you for subscribing! You will receive our latest updates.';
            
            this.appendChild(successAlert);
            this.reset();
            
            setTimeout(() => {
                successAlert.remove();
            }, 5000);
        }
    });
    
    // Load more posts functionality
    const loadMoreBtn = document.getElementById('loadMorePosts');
    let currentPage = 1;
    
    loadMoreBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Loading...';
        
        // Simulate loading more posts
        setTimeout(() => {
            this.innerHTML = '<i class="bi bi-arrow-down me-2"></i>Load More Articles';
            
            // Here you would typically fetch more posts from the server
            // For demo, we'll just show a message
            const message = document.createElement('div');
            message.className = 'alert alert-info mt-3';
            message.innerHTML = '<i class="bi bi-info-circle me-2"></i>No more articles to load.';
            
            this.parentElement.appendChild(message);
            this.style.display = 'none';
            
            setTimeout(() => {
                message.remove();
            }, 3000);
        }, 1500);
    });
    
    // Category filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter blog posts
            blogCards.forEach(card => {
                const cardCategory = card.dataset.category;
                
                if (filter === 'all' || cardCategory === filter) {
                    card.parentElement.style.display = 'block';
                    card.classList.add('fade-in');
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    });
});

// Share functionality
function sharePost(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        });
    } else {
        // Fallback for browsers without Web Share API
        const sharePopup = document.createElement('div');
        sharePopup.className = 'share-popup';
        sharePopup.innerHTML = `
            <h5>Share this article</h5>
            <div class="share-buttons">
                <a href="https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}" target="_blank" class="btn btn-primary">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" target="_blank" class="btn btn-primary">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}" target="_blank" class="btn btn-primary">
                    <i class="bi bi-linkedin"></i>
                </a>
                <button class="btn btn-secondary" onclick="copyToClipboard('${url}')">
                    <i class="bi bi-clipboard"></i>
                </button>
            </div>
            <button class="btn btn-sm btn-outline-secondary mt-3" onclick="closeSharePopup()">Close</button>
        `;
        
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop';
        backdrop.onclick = closeSharePopup;
        
        document.body.appendChild(backdrop);
        document.body.appendChild(sharePopup);
    }
}

function closeSharePopup() {
    document.querySelector('.share-popup')?.remove();
    document.querySelector('.modal-backdrop')?.remove();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Link copied to clipboard!');
        closeSharePopup();
    });
}
</script>
