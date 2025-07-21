<!-- Blog Post Header -->
<section class="blog-hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="blog-header text-center">
                    <span class="badge bg-primary mb-3"><?= ucfirst($post['category']) ?></span>
                    <h1 class="blog-title"><?= esc($post['title']) ?></h1>
                    <div class="blog-meta">
                        <span class="author">
                            <i class="bi bi-person"></i>
                            By <?= esc($post['author']) ?>
                        </span>
                        <span class="date">
                            <i class="bi bi-calendar"></i>
                            <?= date('F j, Y', strtotime($post['published_at'] ?? $post['created_at'])) ?>
                        </span>
                        <span class="reading-time">
                            <i class="bi bi-clock"></i>
                            <?= ceil(str_word_count(strip_tags($post['content'])) / 200) ?> min read
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Post Content -->
<section class="blog-content-section section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Featured Image -->
                <?php if (!empty($post['featured_image'])): ?>
                <div class="featured-image mb-4">
                    <img src="<?= base_url($post['featured_image']) ?>" 
                         alt="<?= esc($post['title']) ?>" 
                         class="img-fluid rounded">
                </div>
                <?php endif; ?>

                <!-- Article Content -->
                <div class="article-content">
                    <?= $post['content'] ?>
                </div>

                <!-- Tags -->
                <?php if (!empty($post['tags'])): ?>
                <div class="article-tags mt-4">
                    <h6>Tags:</h6>
                    <?php 
                    $tags = explode(',', $post['tags']);
                    foreach ($tags as $tag): 
                        $tag = trim($tag);
                    ?>
                    <span class="badge bg-light text-dark me-2"><?= esc($tag) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Social Sharing -->
                <div class="social-sharing mt-5">
                    <h6>Share this article:</h6>
                    <div class="social-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" 
                           target="_blank" 
                           class="btn btn-facebook">
                            <i class="bi bi-facebook"></i>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($post['title']) ?>" 
                           target="_blank" 
                           class="btn btn-twitter">
                            <i class="bi bi-twitter"></i>
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(current_url()) ?>" 
                           target="_blank" 
                           class="btn btn-linkedin">
                            <i class="bi bi-linkedin"></i>
                            LinkedIn
                        </a>
                        <a href="https://wa.me/?text=<?= urlencode($post['title'] . ' ' . current_url()) ?>" 
                           target="_blank" 
                           class="btn btn-whatsapp">
                            <i class="bi bi-whatsapp"></i>
                            WhatsApp
                        </a>
                        <button onclick="copyToClipboard('<?= current_url() ?>')" 
                                class="btn btn-copy">
                            <i class="bi bi-link-45deg"></i>
                            Copy Link
                        </button>
                    </div>
                </div>

                <!-- Newsletter Subscription -->
                <div class="newsletter-subscription mt-5 p-4 bg-light rounded">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5>Stay Updated with R-CAT Insights</h5>
                            <p class="mb-md-0">Get the latest career guidance and industry trends delivered to your inbox.</p>
                        </div>
                        <div class="col-md-4">
                            <form class="newsletter-form" id="newsletterForm">
                                <div class="input-group">
                                    <input type="email" 
                                           class="form-control" 
                                           placeholder="Your email" 
                                           required 
                                           id="newsletterEmail">
                                    <button type="submit" class="btn btn-primary">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts -->
<?php if (!empty($related_posts)): ?>
<section class="related-posts-section section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="section-title text-center mb-5">Related Articles</h3>
                <div class="row">
                    <?php foreach ($related_posts as $related): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card blog-card h-100">
                            <?php if (!empty($related['featured_image'])): ?>
                            <img src="<?= base_url($related['featured_image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= esc($related['title']) ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= base_url('blog/' . $related['slug']) ?>">
                                        <?= esc($related['title']) ?>
                                    </a>
                                </h5>
                                <p class="card-text"><?= esc($related['excerpt']) ?></p>
                                <a href="<?= base_url('blog/' . $related['slug']) ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Custom CSS for Blog Post -->
<style>
.blog-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0 60px;
}

.blog-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.blog-meta {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.blog-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.article-content h2,
.article-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-content blockquote {
    border-left: 4px solid #007bff;
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    background: #f8f9fa;
    padding: 1rem 1.5rem;
}

.social-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.social-buttons .btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
}

.btn-facebook {
    background: #1877f2;
    border-color: #1877f2;
    color: white;
}

.btn-twitter {
    background: #1da1f2;
    border-color: #1da1f2;
    color: white;
}

.btn-linkedin {
    background: #0077b5;
    border-color: #0077b5;
    color: white;
}

.btn-whatsapp {
    background: #25d366;
    border-color: #25d366;
    color: white;
}

.btn-copy {
    background: #6c757d;
    border-color: #6c757d;
    color: white;
}

.newsletter-form .input-group {
    border-radius: 25px;
    overflow: hidden;
}

.newsletter-form .form-control {
    border: none;
    box-shadow: none;
}

.newsletter-form .btn {
    border-radius: 0;
}

.blog-card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
}

.blog-card .card-title a {
    color: #2c3e50;
    text-decoration: none;
}

.blog-card .card-title a:hover {
    color: #007bff;
}

@media (max-width: 768px) {
    .blog-title {
        font-size: 2rem;
    }
    
    .blog-meta {
        font-size: 0.9rem;
    }
    
    .social-buttons {
        justify-content: center;
    }
}
</style>

<!-- JavaScript for Social Sharing -->
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('.btn-copy');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check"></i> Copied!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-copy');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-copy');
        }, 2000);
    });
}

// Newsletter subscription
document.getElementById('newsletterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('newsletterEmail').value;
    const btn = this.querySelector('button[type="submit"]');
    const originalText = btn.innerHTML;
    
    btn.innerHTML = 'Subscribing...';
    btn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        btn.innerHTML = 'Subscribed!';
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            btn.classList.remove('btn-success');
            document.getElementById('newsletterEmail').value = '';
        }, 2000);
    }, 1000);
});
</script>
