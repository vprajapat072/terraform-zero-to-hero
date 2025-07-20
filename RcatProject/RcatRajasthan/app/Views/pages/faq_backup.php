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
        <div class="row">
            <div class="col-12">
                <div class="category-nav fade-in">
                    <div class="nav nav-pills justify-content-center" id="faq-category-tabs">
                        <button class="nav-link active" onclick="showCategory('all')" data-category="all">
                            <i class="bi bi-grid-3x3-gap me-2"></i>All Questions
                        </button>
                        <?php if (isset($categories) && is_array($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                        <button class="nav-link" onclick="showCategory('<?= htmlspecialchars($category['slug'] ?? '') ?>')" data-category="<?= htmlspecialchars($category['slug'] ?? '') ?>">
                            <i class="bi bi-folder me-2"></i><?= htmlspecialchars($category['name'] ?? '') ?>
                        </button>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="faqContainer">
                    <?php if (isset($faqsByCategory) && is_array($faqsByCategory)): ?>
                    <?php foreach ($faqsByCategory as $categoryName => $faqs): ?>
                    <div class="faq-category fade-in" data-category="<?= strtolower(str_replace(' ', '-', $categoryName)) ?>">
                        <h3 class="category-title">
                            <i class="bi bi-bookmark-fill me-2"></i>
                            <?= htmlspecialchars($categoryName) ?>
                        </h3>
                        
                        <div class="faq-list">
                            <?php foreach ($faqs as $faq): ?>
                            <div class="faq-item" data-question="<?= strtolower($faq['question'] ?? '') ?>" data-answer="<?= strtolower($faq['answer'] ?? '') ?>">
                                <div class="faq-question" onclick="toggleFAQ(this)">
                                    <h5><?= htmlspecialchars($faq['question'] ?? '') ?></h5>
                                    <i class="bi bi-plus-circle faq-icon"></i>
                                </div>
                                <div class="faq-answer">
                                    <p><?= nl2br(htmlspecialchars($faq['answer'] ?? '')) ?></p>
                                    <div class="faq-actions">
                                        <small class="text-muted">Was this helpful?</small>
                                        <button class="btn btn-sm btn-outline-success ms-2" onclick="rateFAQ(<?= $faq['id'] ?? 0 ?>, 'helpful')">
                                            <i class="bi bi-hand-thumbs-up"></i> Yes
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger ms-1" onclick="rateFAQ(<?= $faq['id'] ?? 0 ?>, 'not-helpful')">
                                            <i class="bi bi-hand-thumbs-down"></i> No
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-info-circle text-muted" style="font-size: 3rem;"></i>
                        <h4 class="mt-3">FAQ System Loading...</h4>
                        <p class="text-muted">Please check back soon for frequently asked questions.</p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- No Results Message -->
                <div id="noResults" class="text-center py-5" style="display: none;">
                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">No questions found</h4>
                    <p class="text-muted">Try different keywords or browse by category</p>
                    <a href="/contact" class="btn btn-primary">
                        <i class="bi bi-envelope me-2"></i>Ask a Question
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="section bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4 fade-in">Still Have Questions?</h2>
                <p class="lead mb-4 fade-in">Our team is here to help you with personalized assistance and guidance.</p>
                <div class="fade-in">
                    <a href="/contact" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-envelope me-2"></i>Contact Us
                    </a>
                    <a href="/admission" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Start Application
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    padding: 80px 0;
}

.search-box {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.category-nav {
    margin-bottom: 30px;
}

.category-nav .nav-pills .nav-link {
    border-radius: 25px;
    margin: 5px;
    transition: all 0.3s ease;
}

.category-nav .nav-pills .nav-link:hover,
.category-nav .nav-pills .nav-link.active {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.faq-category {
    margin-bottom: 40px;
}

.category-title {
    color: var(--primary-color);
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.faq-item {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    margin-bottom: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.faq-question {
    padding: 20px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    transition: background 0.3s ease;
}

.faq-question:hover {
    background: #e9ecef;
}

.faq-question h5 {
    margin: 0;
    flex-grow: 1;
    color: #333;
}

.faq-icon {
    font-size: 1.5rem;
    color: var(--primary-color);
    transition: transform 0.3s ease;
}

.faq-item.active .faq-icon {
    transform: rotate(45deg);
}

.faq-answer {
    padding: 20px;
    display: none;
    border-top: 1px solid #e9ecef;
    background: white;
}

.faq-item.active .faq-answer {
    display: block;
    animation: slideDown 0.3s ease;
}

.faq-actions {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #f1f3f4;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .category-nav .nav-pills {
        flex-wrap: wrap;
    }
    
    .category-nav .nav-pills .nav-link {
        margin: 2px;
        font-size: 0.9rem;
    }
}
</style>

<script>
function toggleFAQ(element) {
    const faqItem = element.parentElement;
    const isActive = faqItem.classList.contains('active');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-item.active').forEach(item => {
        item.classList.remove('active');
    });
    
    // Toggle current item
    if (!isActive) {
        faqItem.classList.add('active');
    }
}

function showCategory(category) {
    // Update active tab
    document.querySelectorAll('#faq-category-tabs .nav-link').forEach(tab => {
        tab.classList.remove('active');
    });
    const activeTab = document.querySelector(`[data-category="${category}"]`);
    if (activeTab) {
        activeTab.classList.add('active');
    }
    
    // Show/hide categories
    const categories = document.querySelectorAll('.faq-category');
    categories.forEach(cat => {
        if (category === 'all' || cat.dataset.category === category) {
            cat.style.display = 'block';
        } else {
            cat.style.display = 'none';
        }
    });
    
    // Clear search
    const searchInput = document.getElementById('faqSearch');
    if (searchInput) {
        searchInput.value = '';
    }
    const noResults = document.getElementById('noResults');
    if (noResults) {
        noResults.style.display = 'none';
    }
}

function searchFAQs() {
    const searchInput = document.getElementById('faqSearch');
    if (!searchInput) return;
    
    const searchTerm = searchInput.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    let hasResults = false;
    
    if (searchTerm === '') {
        // Show all items in current category
        const activeTab = document.querySelector('#faq-category-tabs .nav-link.active');
        const activeCategory = activeTab ? activeTab.dataset.category : 'all';
        showCategory(activeCategory);
        return;
    }
    
    faqItems.forEach(item => {
        const question = item.dataset.question || '';
        const answer = item.dataset.answer || '';
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
            if (item.parentElement && item.parentElement.parentElement) {
                item.parentElement.parentElement.style.display = 'block';
            }
            hasResults = true;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Hide empty categories
    document.querySelectorAll('.faq-category').forEach(category => {
        const visibleItems = category.querySelectorAll('.faq-item[style*="block"], .faq-item:not([style*="none"])');
        if (visibleItems.length === 0) {
            category.style.display = 'none';
        }
    });
    
    // Show no results message
    const noResults = document.getElementById('noResults');
    if (noResults) {
        noResults.style.display = hasResults ? 'none' : 'block';
    }
}

function rateFAQ(faqId, rating) {
    // Here you would typically send an AJAX request to rate the FAQ
    const message = rating === 'helpful' ? 'Thank you for your feedback!' : 'Thanks! We\'ll work on improving this answer.';
    if (typeof showToast === 'function') {
        showToast(message, 'success');
    } else {
        alert(message);
    }
}
</script>

<?php
}
?>
?>

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
            
            <!-- FAQ Content -->
            <div class="col-lg-9">
                <?php foreach ($faqs as $categoryIndex => $category): ?>
                <div class="faq-category mb-5" data-category="<?= strtolower($category['category']) ?>">
                    <h3 class="category-title"><?= esc($category['category']) ?></h3>
                    
                    <div class="accordion" id="faqAccordion<?= $categoryIndex ?>">
                        <?php foreach ($category['questions'] as $qIndex => $qa): ?>
                        <div class="accordion-item faq-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq<?= $categoryIndex ?>_<?= $qIndex ?>" 
                                        aria-expanded="false">
                                    <?= esc($qa['question']) ?>
                                </button>
                            </h2>
                            <div id="faq<?= $categoryIndex ?>_<?= $qIndex ?>" 
                                 class="accordion-collapse collapse" 
                                 data-bs-parent="#faqAccordion<?= $categoryIndex ?>">
                                <div class="accordion-body">
                                    <?= esc($qa['answer']) ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <!-- No Results Message -->
                <div id="noResults" class="text-center py-5" style="display: none;">
                    <div class="no-results">
                        <i class="bi bi-search display-1 text-muted"></i>
                        <h4 class="mt-3">No matching questions found</h4>
                        <p class="text-muted">Try adjusting your search terms or browse categories above.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="faq-cta-section section bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h3>Still have questions?</h3>
                <p class="lead">Can't find the answer you're looking for? Our admission counselors are here to help.</p>
                <div class="cta-buttons mt-4">
                    <a href="/admission" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-person-check"></i>
                        Contact Admissions
                    </a>
                    <a href="tel:+919876543210" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-telephone"></i>
                        Call Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
.faq-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.faq-search .form-control {
    border-radius: 50px 0 0 50px;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.faq-search .btn {
    border-radius: 0 50px 50px 0;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.faq-categories {
    top: 100px;
}

.faq-categories h5 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

.faq-categories .list-group-item {
    border: none;
    border-radius: 10px;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.faq-categories .list-group-item:hover,
.faq-categories .list-group-item.active {
    background: #007bff;
    color: white;
}

.category-title {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: 10px !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.accordion-button {
    border-radius: 10px !important;
    border: none;
    box-shadow: none;
    font-weight: 600;
    padding: 1.25rem 1.5rem;
}

.accordion-button:not(.collapsed) {
    background: #f8f9fa;
    color: #007bff;
}

.accordion-button:focus {
    box-shadow: none;
    border: none;
}

.accordion-body {
    padding: 1.5rem;
    color: #6c757d;
    line-height: 1.7;
}

.faq-cta-section {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.no-results i {
    opacity: 0.3;
}

@media (max-width: 992px) {
    .faq-categories {
        position: static !important;
    }
    
    .faq-categories .list-group {
        display: flex;
        overflow-x: auto;
        padding-bottom: 1rem;
    }
    
    .faq-categories .list-group-item {
        white-space: nowrap;
        margin-right: 0.5rem;
        margin-bottom: 0;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .cta-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
}
</style>

<!-- JavaScript for FAQ functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('faqSearch');
    const categoryButtons = document.querySelectorAll('[data-category]');
    const faqCategories = document.querySelectorAll('.faq-category');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('noResults');
    
    let currentCategory = 'all';
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        filterFAQs(searchTerm, currentCategory);
    });
    
    // Category filter
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active category button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            currentCategory = this.dataset.category;
            const searchTerm = searchInput.value.toLowerCase();
            filterFAQs(searchTerm, currentCategory);
        });
    });
    
    function filterFAQs(searchTerm, category) {
        let visibleCount = 0;
        
        faqCategories.forEach(categoryDiv => {
            const categoryName = categoryDiv.dataset.category;
            let categoryHasVisible = false;
            
            // Show/hide based on category
            if (category === 'all' || category === categoryName) {
                const items = categoryDiv.querySelectorAll('.faq-item');
                
                items.forEach(item => {
                    const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                    const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                    
                    if (searchTerm === '' || question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        categoryHasVisible = true;
                        visibleCount++;
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
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }
    
    // Highlight search terms
    function highlightSearchTerm(text, term) {
        if (!term) return text;
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }
});
</script>
