<!-- FAQ JSON-LD Schema -->
<?php if (isset($faqSchema)): ?>
<script type="application/ld+json">
<?= json_encode($faqSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
</script>
<?php endif; ?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="display-4 fade-in">Frequently Asked Questions</h1>
                    <p class="lead fade-in">Find answers to common questions about R-CAT Rajasthan courses, admission process, and more.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="hero-image text-center fade-in">
                    <i class="bi bi-question-circle" style="font-size: 8rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Search Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="search-box fade-in">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="faqSearch" placeholder="Search for questions..." onkeyup="searchFAQs()">
                    </div>
                    <div class="mt-3 text-center">
                        <small class="text-muted">Can't find what you're looking for? <a href="/contact">Contact us</a> for personalized help.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Categories Navigation -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="category-filters text-center mb-5 fade-in">
                    <div class="btn-group btn-group-lg flex-wrap" role="group">
                        <button type="button" class="btn btn-outline-primary active" onclick="showCategory('all')">All Questions</button>
                        <?php if (isset($categories) && is_array($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <button type="button" class="btn btn-outline-primary" onclick="showCategory('<?= $category['slug'] ?>')"><?= htmlspecialchars($category['name']) ?></button>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section class="section pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="faqContent">
                    <?php if (isset($faqsByCategory) && is_array($faqsByCategory)): ?>
                    <?php foreach ($faqsByCategory as $categoryName => $faqs): ?>
                    <div class="faq-category mb-5 fade-in" data-category="<?= $categoryName ?>">
                        <div class="category-header">
                            <h2 class="h3 text-primary mb-4">
                                <i class="bi bi-question-circle-fill me-2"></i>
                                <?= ucfirst(str_replace('-', ' ', $categoryName)) ?>
                            </h2>
                        </div>
                        
                        <div class="accordion accordion-flush" id="accordion<?= ucfirst($categoryName) ?>">
                            <?php foreach ($faqs as $faq): ?>
                            <div class="accordion-item border border-light rounded mb-3 shadow-sm faq-item" data-category="<?= $faq['category_slug'] ?>">
                                <h3 class="accordion-header" id="heading<?= $faq['id'] ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $faq['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $faq['id'] ?>" onclick="toggleFAQ(this)">
                                        <span class="fw-medium"><?= htmlspecialchars($faq['question']) ?></span>
                                    </button>
                                </h3>
                                <div id="collapse<?= $faq['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $faq['id'] ?>" data-bs-parent="#accordion<?= ucfirst($categoryName) ?>">
                                    <div class="accordion-body">
                                        <p class="mb-3"><?= htmlspecialchars($faq['answer']) ?></p>
                                        
                                        <!-- FAQ Rating and Actions -->
                                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                            <div class="faq-actions">
                                                <small class="text-muted me-3">Was this helpful?</small>
                                                <button class="btn btn-sm btn-outline-success me-2" onclick="rateFAQ(<?= $faq['id'] ?>, 'helpful')">
                                                    <i class="bi bi-hand-thumbs-up"></i> Yes
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="rateFAQ(<?= $faq['id'] ?>, 'not-helpful')">
                                                    <i class="bi bi-hand-thumbs-down"></i> No
                                                </button>
                                            </div>
                                            <div class="share-actions">
                                                <button class="btn btn-sm btn-outline-primary" onclick="shareFAQ(<?= $faq['id'] ?>, '<?= htmlspecialchars($faq['question']) ?>')">
                                                    <i class="bi bi-share"></i> Share
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-question-circle text-muted" style="font-size: 4rem;"></i>
                        <h3 class="mt-3">No FAQs Available</h3>
                        <p class="text-muted">We're working on adding more frequently asked questions. Please check back soon!</p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- No Search Results Message -->
                <div id="noSearchResults" class="text-center py-5" style="display: none;">
                    <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                    <h3 class="mt-3">No Results Found</h3>
                    <p class="text-muted">Try searching with different keywords or browse all questions.</p>
                    <button class="btn btn-primary" onclick="document.getElementById('faqSearch').value=''; searchFAQs();">
                        <i class="bi bi-arrow-clockwise"></i> Clear Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Still Have Questions Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="cta-section fade-in">
                    <h2 class="h3 mb-3">Still Have Questions?</h2>
                    <p class="text-muted mb-4">Can't find what you're looking for? Our team is here to help you with any questions about R-CAT courses and admission.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="/contact" class="btn btn-primary btn-lg me-md-2">
                            <i class="bi bi-envelope"></i> Contact Us
                        </a>
                        <a href="/courses" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-book"></i> Browse Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
.hero-section {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    padding: 4rem 0;
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
    padding: 3rem 0;
}

.search-box .form-control {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    padding: 1rem 1.5rem;
    font-size: 1.1rem;
}

.search-box .input-group-text {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    padding: 1rem 1.5rem;
}

.category-filters .btn {
    margin: 0.25rem;
    border-radius: 2rem;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}

.category-filters .btn:hover,
.category-filters .btn.active {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.25);
}

.faq-category {
    margin-bottom: 3rem;
}

.category-header h2 {
    border-bottom: 2px solid #007bff;
    padding-bottom: 0.5rem;
    display: inline-block;
}

.accordion-item {
    transition: all 0.3s ease;
}

.accordion-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.accordion-button {
    font-weight: 500;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.accordion-body {
    padding: 1.5rem;
    background: #ffffff;
}

.faq-actions .btn {
    border-radius: 1.5rem;
    padding: 0.375rem 1rem;
}

.share-actions .btn {
    border-radius: 1.5rem;
    padding: 0.375rem 1rem;
}

.cta-section {
    background: white;
    padding: 3rem;
    border-radius: 1rem;
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
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

mark {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    padding: 0.1rem 0.3rem;
    border-radius: 0.25rem;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 0;
    }
    
    .category-filters .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .category-filters .btn {
        width: 100%;
        margin: 0.25rem 0;
    }
    
    .d-grid.gap-2.d-md-flex .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<!-- FAQ Interactive JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize FAQ functionality
    const searchInput = document.getElementById('faqSearch');
    const noResults = document.getElementById('noSearchResults');
    const faqContent = document.getElementById('faqContent');
    
    // Search functionality
    window.searchFAQs = function() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const categories = document.querySelectorAll('.faq-category');
        const noResults = document.getElementById('noSearchResults');
        let visibleCount = 0;
        
        categories.forEach(categoryDiv => {
            const items = categoryDiv.querySelectorAll('.faq-item');
            let categoryHasVisible = false;
            
            if (items.length > 0) {
                items.forEach(item => {
                    const question = item.querySelector('.accordion-button span').textContent.toLowerCase();
                    const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                    
                    if (searchTerm === '' || question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        categoryHasVisible = true;
                        visibleCount++;
                        
                        // Highlight search terms
                        if (searchTerm) {
                            const questionEl = item.querySelector('.accordion-button span');
                            const answerEl = item.querySelector('.accordion-body p');
                            questionEl.innerHTML = highlightSearchTerm(questionEl.textContent, searchTerm);
                            answerEl.innerHTML = highlightSearchTerm(answerEl.textContent, searchTerm);
                        }
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                categoryDiv.style.display = categoryHasVisible ? 'block' : 'none';
            } else {
                categoryDiv.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        noResults.style.display = visibleCount === 0 && searchTerm !== '' ? 'block' : 'none';
        faqContent.style.display = visibleCount === 0 && searchTerm !== '' ? 'none' : 'block';
    }
    
    // Category filtering
    window.showCategory = function(category) {
        const buttons = document.querySelectorAll('.category-filters .btn');
        const categories = document.querySelectorAll('.faq-category');
        
        // Update active button
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        // Show/hide categories
        categories.forEach(categoryDiv => {
            if (category === 'all' || categoryDiv.dataset.category === category) {
                categoryDiv.style.display = 'block';
            } else {
                categoryDiv.style.display = 'none';
            }
        });
        
        // Clear search when filtering
        searchInput.value = '';
        noResults.style.display = 'none';
        faqContent.style.display = 'block';
    }
    
    // FAQ toggle animation
    window.toggleFAQ = function(element) {
        const icon = element.querySelector('i');
        if (icon) {
            if (element.classList.contains('collapsed')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        }
    }
    
    // Rating functionality
    window.rateFAQ = function(faqId, rating) {
        // Here you would typically send the rating to your backend
        const message = rating === 'helpful' ? 'Thank you for your feedback!' : 'Thanks! We\'ll work on improving this answer.';
        
        // Show success message (you can replace this with a proper notification system)
        if (typeof showToast === 'function') {
            showToast(message, 'success');
        } else {
            alert(message);
        }
    }
    
    // Share functionality
    window.shareFAQ = function(faqId, question) {
        if (navigator.share) {
            navigator.share({
                title: question,
                text: 'Check out this FAQ about R-CAT Rajasthan courses',
                url: window.location.href + '#faq-' + faqId
            });
        } else {
            // Fallback to copying URL
            const url = window.location.href + '#faq-' + faqId;
            navigator.clipboard.writeText(url).then(() => {
                if (typeof showToast === 'function') {
                    showToast('Link copied to clipboard!', 'success');
                } else {
                    alert('Link copied to clipboard!');
                }
            });
        }
    }
    
    // Highlight search terms
    function highlightSearchTerm(text, term) {
        if (!term) return text;
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }
});
</script>
