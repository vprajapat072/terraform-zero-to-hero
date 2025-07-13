<!-- FAQ Hero Section -->
<section class="faq-hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="hero-title">Frequently Asked Questions</h1>
                <p class="hero-subtitle">Find answers to common questions about R-CAT Rajasthan courses, admission process, and more.</p>
                
                <!-- Search Box -->
                <div class="faq-search mt-4">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control form-control-lg" 
                               placeholder="Search for questions..." 
                               id="faqSearch">
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section class="faq-content-section section">
    <div class="container">
        <div class="row">
            <!-- Category Filter -->
            <div class="col-lg-3 mb-5">
                <div class="faq-categories sticky-top">
                    <h5>Categories</h5>
                    <div class="list-group" id="faqCategories">
                        <button class="list-group-item list-group-item-action active" 
                                data-category="all">
                            All Questions
                        </button>
                        <?php foreach ($faqs as $category): ?>
                        <button class="list-group-item list-group-item-action" 
                                data-category="<?= strtolower($category['category']) ?>">
                            <?= esc($category['category']) ?>
                            <span class="badge bg-primary rounded-pill">
                                <?= count($category['questions']) ?>
                            </span>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
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
