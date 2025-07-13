<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' | ' . Config::SITE_NAME : Config::SITE_NAME ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : Config::SITE_DESCRIPTION ?>">
    <meta name="keywords" content="<?= isset($pageKeywords) ? $pageKeywords : Config::DEFAULT_META_KEYWORDS ?>">
    
    <!-- SEO Meta Tags -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="<?= Config::SITE_NAME ?>">
    <link rel="canonical" href="<?= Config::SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?= isset($pageTitle) ? $pageTitle : Config::SITE_NAME ?>">
    <meta property="og:description" content="<?= isset($pageDescription) ? $pageDescription : Config::SITE_DESCRIPTION ?>">
    <meta property="og:url" content="<?= Config::SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= Config::SITE_URL ?>/assets/images/og-image.jpg">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= isset($pageTitle) ? $pageTitle : Config::SITE_NAME ?>">
    <meta name="twitter:description" content="<?= isset($pageDescription) ? $pageDescription : Config::SITE_DESCRIPTION ?>">
    <meta name="twitter:image" content="<?= Config::SITE_URL ?>/assets/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    
    <!-- Preconnect to external domains for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="language" content="English">
    <meta name="geo.region" content="IN-RJ">
    <meta name="geo.placename" content="Rajasthan">
    <meta name="theme-color" content="#007bff">
    
    <!-- Performance and Security Headers -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= Config::GOOGLE_ANALYTICS_ID ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= Config::GOOGLE_ANALYTICS_ID ?>');
    </script>
    
    <!-- Schema Markup for Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "R-CAT Rajasthan",
        "url": "https://rcatrajasthan.com",
        "logo": "https://rcatrajasthan.com/assets/images/logo.png",
        "description": "Government skill development programs and courses in Rajasthan"
    }
    </script>
    
    <!-- Page-specific Schema Markup -->
    <?php if (isset($schema_markup)): ?>
        <?= $schema_markup ?>
    <?php endif; ?>
    
    <!-- Breadcrumb Schema -->
    <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
                {
                    "@type": "ListItem",
                    "position": <?= $index + 1 ?>,
                    "name": "<?= htmlspecialchars($breadcrumb['name']) ?>",
                    "item": "<?= htmlspecialchars($breadcrumb['url']) ?>"
                }<?= $index < count($breadcrumbs) - 1 ? ',' : '' ?>
                <?php endforeach; ?>
            ]
        }
        </script>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-mortarboard me-2"></i>
                R-CAT Rajasthan
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/courses">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admission">Admission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Disclaimer Banner -->
    <div class="alert alert-warning alert-dismissible fade show m-0 text-center" role="alert">
        <small>
            <i class="bi bi-info-circle me-1"></i>
            <strong>Disclaimer:</strong> This is an unofficial website created to provide easy access to R-CAT information. 
            Please verify all details with the official R-CAT website.
        </small>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    
    <!-- Main Content -->
    <main>
        <?= $content ?>
    </main>
    
    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="mb-3">R-CAT Rajasthan</h5>
                    <p>Your fastest and most comprehensive guide to R-CAT courses and information.</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-light">Home</a></li>
                        <li><a href="/about" class="text-light">About</a></li>
                        <li><a href="/courses" class="text-light">Courses</a></li>
                        <li><a href="/admission" class="text-light">Admission</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Resources</h6>
                    <ul class="list-unstyled">
                        <li><a href="/blog" class="text-light">Blog</a></li>
                        <li><a href="#" class="text-light">FAQ</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                        <li><a href="#" class="text-light">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Newsletter</h6>
                    <p>Get updates on new courses and R-CAT news.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?= date('Y') ?> R-CAT Rajasthan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <a href="#" class="text-light">Privacy Policy</a> | 
                        <a href="#" class="text-light">Terms of Service</a>
                    </small>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="/assets/js/script.js"></script>
</body>
</html>
