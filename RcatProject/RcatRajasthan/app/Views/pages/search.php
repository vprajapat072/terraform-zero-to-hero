<!DOCTYPE html>
<div class="search-page">
    <!-- Search Header -->
    <div class="search-header bg-gradient-primary text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="text-center mb-4">Search R-CAT Rajasthan</h1>
                    
                    <!-- Advanced Search Form -->
                    <form method="GET" action="<?= base_url('search') ?>" class="search-form">
                        <div class="search-input-group">
                            <div class="input-group input-group-lg">
                                <input type="text" 
                                       class="form-control search-input" 
                                       name="q" 
                                       value="<?= esc($query) ?>" 
                                       placeholder="Search courses, blog posts, and more..."
                                       autocomplete="off"
                                       id="searchInput">
                                
                                <div class="input-group-append">
                                    <select name="type" class="form-select search-filter">
                                        <option value="all" <?= $type === 'all' ? 'selected' : '' ?>>All</option>
                                        <option value="courses" <?= $type === 'courses' ? 'selected' : '' ?>>Courses</option>
                                        <option value="blog" <?= $type === 'blog' ? 'selected' : '' ?>>Blog</option>
                                    </select>
                                    
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Search Suggestions -->
                            <div id="searchSuggestions" class="search-suggestions"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="search-results py-5">
        <div class="container">
            <?php if (!empty($query)): ?>
                <!-- Results Summary -->
                <div class="results-summary mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="h4 mb-0">
                                <?php if ($total_results > 0): ?>
                                    Found <?= number_format($total_results) ?> results for 
                                    <strong>"<?= esc($query) ?>"</strong>
                                <?php else: ?>
                                    No results found for "<strong><?= esc($query) ?></strong>"
                                <?php endif; ?>
                            </h2>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="search-filters">
                                <small class="text-muted">Filter by:</small>
                                <div class="btn-group btn-group-sm ms-2" role="group">
                                    <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['type' => 'all'])) ?>" 
                                       class="btn <?= $type === 'all' ? 'btn-primary' : 'btn-outline-secondary' ?>">All</a>
                                    <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['type' => 'courses'])) ?>" 
                                       class="btn <?= $type === 'courses' ? 'btn-primary' : 'btn-outline-secondary' ?>">Courses</a>
                                    <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['type' => 'blog'])) ?>" 
                                       class="btn <?= $type === 'blog' ? 'btn-primary' : 'btn-outline-secondary' ?>">Blog</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($results)): ?>
                    <!-- Search Results List -->
                    <div class="results-list">
                        <?php foreach ($results as $result): ?>
                            <div class="result-item card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="result-content">
                                                <!-- Result Type Badge -->
                                                <span class="badge bg-<?= $result['type'] === 'course' ? 'success' : 'info' ?> mb-2">
                                                    <i class="fas fa-<?= $result['type'] === 'course' ? 'graduation-cap' : 'blog' ?>"></i>
                                                    <?= ucfirst($result['type']) ?>
                                                </span>
                                                
                                                <!-- Result Title -->
                                                <h3 class="result-title h5 mb-2">
                                                    <a href="<?= $result['url'] ?>" class="text-decoration-none">
                                                        <?= esc($result['title']) ?>
                                                    </a>
                                                </h3>
                                                
                                                <!-- Result Excerpt -->
                                                <p class="result-excerpt text-muted mb-2">
                                                    <?= $result['excerpt'] ?>
                                                </p>
                                                
                                                <!-- Result URL -->
                                                <div class="result-url">
                                                    <small class="text-success">
                                                        <i class="fas fa-link"></i>
                                                        <?= $result['url'] ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="result-meta">
                                                <?php if ($result['type'] === 'course'): ?>
                                                    <div class="course-meta">
                                                        <?php if (isset($result['duration'])): ?>
                                                            <div class="meta-item mb-1">
                                                                <small class="text-muted">
                                                                    <i class="fas fa-clock"></i>
                                                                    Duration: <?= esc($result['duration']) ?>
                                                                </small>
                                                            </div>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (isset($result['fee'])): ?>
                                                            <div class="meta-item mb-1">
                                                                <small class="text-muted">
                                                                    <i class="fas fa-rupee-sign"></i>
                                                                    Fee: ₹<?= number_format($result['fee']) ?>
                                                                </small>
                                                            </div>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (isset($result['level'])): ?>
                                                            <div class="meta-item">
                                                                <span class="badge bg-light text-dark">
                                                                    <?= esc($result['level']) ?>
                                                                </span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php elseif ($result['type'] === 'blog'): ?>
                                                    <div class="blog-meta">
                                                        <?php if (isset($result['author'])): ?>
                                                            <div class="meta-item mb-1">
                                                                <small class="text-muted">
                                                                    <i class="fas fa-user"></i>
                                                                    By <?= esc($result['author']) ?>
                                                                </small>
                                                            </div>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (isset($result['created_at'])): ?>
                                                            <div class="meta-item">
                                                                <small class="text-muted">
                                                                    <i class="fas fa-calendar"></i>
                                                                    <?= date('M j, Y', strtotime($result['created_at'])) ?>
                                                                </small>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <nav aria-label="Search results pagination" class="mt-5">
                            <ul class="pagination justify-content-center">
                                <?php if ($current_page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['page' => $current_page - 1])) ?>">
                                            <i class="fas fa-chevron-left"></i> Previous
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                                    <li class="page-item <?= $i === $current_page ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                                            <?= $i ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($current_page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['page' => $current_page + 1])) ?>">
                                            Next <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- No Results -->
                    <div class="no-results text-center py-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <h3 class="h4 mb-3">No Results Found</h3>
                                <p class="text-muted mb-4">
                                    We couldn't find anything matching "<strong><?= esc($query) ?></strong>".
                                    Try different keywords or browse our popular content below.
                                </p>
                                
                                <div class="search-suggestions-alt">
                                    <h5 class="mb-3">Try searching for:</h5>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        <a href="<?= base_url('search?q=web+development') ?>" class="btn btn-outline-primary btn-sm">Web Development</a>
                                        <a href="<?= base_url('search?q=python') ?>" class="btn btn-outline-primary btn-sm">Python</a>
                                        <a href="<?= base_url('search?q=digital+marketing') ?>" class="btn btn-outline-primary btn-sm">Digital Marketing</a>
                                        <a href="<?= base_url('search?q=data+science') ?>" class="btn btn-outline-primary btn-sm">Data Science</a>
                                        <a href="<?= base_url('search?q=java') ?>" class="btn btn-outline-primary btn-sm">Java</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <!-- Initial Search State -->
                <div class="search-welcome text-center py-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <i class="fas fa-search fa-4x text-primary mb-4"></i>
                            <h2 class="h3 mb-3">Discover Our Content</h2>
                            <p class="text-muted mb-4">
                                Search through our comprehensive collection of courses, blog articles, and resources 
                                to find exactly what you're looking for.
                            </p>
                            
                            <!-- Popular Searches -->
                            <div class="popular-searches">
                                <h5 class="mb-3">Popular Searches:</h5>
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="<?= base_url('search?q=web+development') ?>" class="btn btn-outline-primary">Web Development</a>
                                    <a href="<?= base_url('search?q=python+course') ?>" class="btn btn-outline-primary">Python Course</a>
                                    <a href="<?= base_url('search?q=digital+marketing') ?>" class="btn btn-outline-primary">Digital Marketing</a>
                                    <a href="<?= base_url('search?q=career+guidance') ?>" class="btn btn-outline-primary">Career Guidance</a>
                                    <a href="<?= base_url('search?q=certification') ?>" class="btn btn-outline-primary">Certification</a>
                                </div>
                            </div>
                            
                            <!-- Quick Links -->
                            <div class="quick-links mt-5">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="fas fa-graduation-cap fa-2x text-success mb-3"></i>
                                                <h5 class="card-title">Browse Courses</h5>
                                                <p class="card-text">Explore our comprehensive course catalog</p>
                                                <a href="<?= base_url('courses') ?>" class="btn btn-success">View Courses</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="fas fa-blog fa-2x text-info mb-3"></i>
                                                <h5 class="card-title">Read Blog</h5>
                                                <p class="card-text">Stay updated with latest tech trends</p>
                                                <a href="<?= base_url('blog') ?>" class="btn btn-info">Read Blog</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Search JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const suggestionsContainer = document.getElementById('searchSuggestions');
    let debounceTimer;

    // Auto-suggest functionality
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(debounceTimer);
        
        if (query.length < 2) {
            suggestionsContainer.style.display = 'none';
            return;
        }
        
        debounceTimer = setTimeout(() => {
            fetchSuggestions(query);
        }, 300);
    });

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.style.display = 'none';
        }
    });

    function fetchSuggestions(query) {
        fetch(`<?= base_url('search/suggestions') ?>?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(suggestions => {
                if (suggestions.length > 0) {
                    displaySuggestions(suggestions);
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                suggestionsContainer.style.display = 'none';
            });
    }

    function displaySuggestions(suggestions) {
        let html = '<div class="suggestions-list">';
        
        suggestions.forEach(suggestion => {
            html += `
                <div class="suggestion-item" onclick="selectSuggestion('${suggestion.url}')">
                    <div class="suggestion-content">
                        <div class="suggestion-title">
                            <i class="fas fa-${suggestion.type === 'course' ? 'graduation-cap' : 'blog'}"></i>
                            ${suggestion.title}
                        </div>
                        <div class="suggestion-type badge bg-${suggestion.type === 'course' ? 'success' : 'info'} text-white">
                            ${suggestion.type}
                        </div>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        
        suggestionsContainer.innerHTML = html;
        suggestionsContainer.style.display = 'block';
    }

    function selectSuggestion(url) {
        window.location.href = url;
    }

    // Make selectSuggestion globally available
    window.selectSuggestion = selectSuggestion;
});
</script>

<!-- Search Styles -->
<style>
.search-page .search-input-group {
    position: relative;
}

.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-top: none;
    border-radius: 0 0 0.375rem 0.375rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    display: none;
    max-height: 300px;
    overflow-y: auto;
}

.suggestions-list .suggestion-item {
    padding: 12px 16px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background-color 0.2s;
}

.suggestions-list .suggestion-item:hover {
    background-color: #f8f9fa;
}

.suggestions-list .suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.suggestion-title {
    font-weight: 500;
    color: #333;
}

.suggestion-title i {
    margin-right: 8px;
    width: 16px;
}

.result-item {
    transition: transform 0.2s, box-shadow 0.2s;
}

.result-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.result-title a {
    color: #2c5aa0;
    transition: color 0.2s;
}

.result-title a:hover {
    color: #1e3a5f;
}

.result-excerpt mark {
    background-color: #fff3cd;
    padding: 2px 4px;
    border-radius: 3px;
}

.meta-item {
    font-size: 0.875rem;
}

.search-filter {
    border-left: none;
    border-radius: 0;
}

.search-input {
    border-right: none;
}

@media (max-width: 768px) {
    .search-form .input-group {
        flex-direction: column;
    }
    
    .search-form .input-group-append {
        display: flex;
        width: 100%;
        margin-top: 10px;
    }
    
    .search-filter {
        flex: 1;
        border-radius: 0.375rem 0 0 0.375rem;
        border-right: none;
    }
    
    .search-form button {
        border-radius: 0 0.375rem 0.375rem 0;
    }
    
    .results-summary .col-md-4 {
        margin-top: 15px;
    }
    
    .result-item .col-md-4 {
        margin-top: 15px;
    }
}
</style>
