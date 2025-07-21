<?php

// Include the blog database class
require_once __DIR__ . '/../Data/BlogDatabase.php';

// Define required constants for the layout
if (!defined('SITE_NAME')) {
    define('SITE_NAME', 'R-CAT Rajasthan');
}
if (!defined('SITE_DESCRIPTION')) {
    define('SITE_DESCRIPTION', 'Leading IT training institute in Rajasthan offering professional courses');
}
if (!defined('SITE_URL')) {
    define('SITE_URL', 'https://rcatrajasthan.com');
}

class BlogController {
    
    private $blogDb;
    
    public function __construct() {
        try {
            $this->blogDb = new BlogDatabase();
        } catch (Exception $e) {
            error_log("BlogController Error: " . $e->getMessage());
            // Fallback to static content if database connection fails
            $this->blogDb = null;
        }
    }
    
    public function index() {
        try {
            $pageTitle = "Blog - R-CAT Rajasthan";
            $pageDescription = "Stay updated with the latest career guidance, industry trends, and success stories from R-CAT Rajasthan. Read our expert insights and tips.";
            $pageKeywords = "R-CAT blog, career guidance, industry trends, technology news, skill development tips, success stories";
            
            if ($this->blogDb) {
                // Dynamic content from database
                $this->renderDynamicBlog();
            } else {
                // Fallback to static content
                $this->renderStaticBlog();
            }
            
        } catch (Exception $e) {
            error_log("Blog Index Error: " . $e->getMessage());
            $this->renderStaticBlog();
        }
    }
    
    private function renderDynamicBlog() {
        // Get filter parameters
        $categorySlug = $_GET['category'] ?? '';
        $searchQuery = $_GET['search'] ?? '';
        $page = max(1, intval($_GET['page'] ?? 1));
        $perPage = 6;
        $offset = ($page - 1) * $perPage;
        
        // Build filters
        $filters = [
            'limit' => $perPage,
            'offset' => $offset
        ];
        
        if ($categorySlug) {
            $filters['category_slug'] = $categorySlug;
        }
        
        if ($searchQuery) {
            $filters['search'] = $searchQuery;
        }
        
        // Get blog data
        $categories = $this->blogDb->getCategories();
        $featuredPosts = $this->blogDb->getFeaturedPosts(3);
        $posts = $this->blogDb->getPosts($filters);
        $popularTags = $this->blogDb->getPopularTags(8);
        $totalPosts = $this->blogDb->getPostsCount($filters);
        
        // Calculate pagination
        $totalPages = ceil($totalPosts / $perPage);
        $hasNextPage = $page < $totalPages;
        $hasPrevPage = $page > 1;
        
        // Add pagination info
        $pagination = [
            'current_page' => $page,
            'total_pages' => $totalPages,
            'has_next' => $hasNextPage,
            'has_prev' => $hasPrevPage,
            'next_page' => $hasNextPage ? $page + 1 : null,
            'prev_page' => $hasPrevPage ? $page - 1 : null,
            'total_posts' => $totalPosts
        ];
        
        // If category filter is applied, get category info
        $currentCategory = null;
        if ($categorySlug) {
            $currentCategory = $this->blogDb->getCategoryBySlug($categorySlug);
            if ($currentCategory) {
                $pageTitle = $currentCategory['meta_title'] ?: $currentCategory['name'] . " - R-CAT Rajasthan";
                $pageDescription = $currentCategory['meta_description'] ?: $currentCategory['description'];
            }
        }
        
        // If search query, update page info
        if ($searchQuery) {
            $pageTitle = "Search Results for '{$searchQuery}' - R-CAT Rajasthan";
            $pageDescription = "Search results for '{$searchQuery}' on R-CAT Rajasthan blog.";
        }
        
        // Generate schema markup for blog page
        $blogSchemaData = [
            "@context" => "https://schema.org",
            "@type" => "Blog",
            "name" => "R-CAT Rajasthan Blog",
            "description" => "Technology career guidance, industry trends, and success stories",
            "url" => "https://rcatrajasthan.com/blog",
            "author" => [
                "@type" => "Organization",
                "name" => "R-CAT Rajasthan"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "R-CAT Rajasthan",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "https://rcatrajasthan.com/assets/images/logo.png"
                ]
            ]
        ];
        
        // Load the blog view
        include __DIR__ . '/../Views/layouts/main.php';
    }
    
    private function renderStaticBlog() {
        $pageTitle = "Blog - R-CAT Rajasthan";
        $pageDescription = "Stay updated with the latest career guidance, industry trends, and success stories from R-CAT Rajasthan. Read our expert insights and tips.";
        $pageKeywords = "R-CAT blog, career guidance, industry trends, technology news, skill development tips, success stories";
        
        // Static fallback categories
        $categories = [
            ['id' => 1, 'name' => 'Career Guidance', 'slug' => 'career-guidance'],
            ['id' => 2, 'name' => 'Industry Trends', 'slug' => 'industry-trends'],
            ['id' => 3, 'name' => 'Success Stories', 'slug' => 'success-stories'],
            ['id' => 4, 'name' => 'Course Updates', 'slug' => 'course-updates']
        ];
        
        // Static fallback posts
        $posts = [
            [
                'id' => 1,
                'title' => 'Top 10 Highest Paying Tech Jobs in Rajasthan 2025',
                'slug' => 'top-paying-tech-jobs-rajasthan-2025',
                'excerpt' => 'Discover the most lucrative technology careers available in Rajasthan and how R-CAT courses can help you achieve them.',
                'category_name' => 'Career Guidance',
                'category_slug' => 'career-guidance',
                'author' => 'R-CAT Team',
                'published_at' => '2025-07-10',
                'featured_image' => null,
                'is_featured' => 1,
                'tags' => []
            ],
            [
                'id' => 2,
                'title' => 'Cloud Computing Career Path: From Beginner to Expert',
                'slug' => 'cloud-computing-career-path',
                'excerpt' => 'Complete roadmap for building a successful career in cloud computing with AWS, Azure, and Google Cloud certifications.',
                'category_name' => 'Career Guidance',
                'category_slug' => 'career-guidance',
                'author' => 'R-CAT Team',
                'published_at' => '2025-07-08',
                'featured_image' => null,
                'is_featured' => 1,
                'tags' => []
            ],
            [
                'id' => 3,
                'title' => 'Why Rajasthan is Becoming India\'s Next Tech Hub',
                'slug' => 'rajasthan-emerging-tech-hub',
                'excerpt' => 'Explore how Rajasthan is transforming into a major technology destination and the opportunities it creates for IT professionals.',
                'category_name' => 'Industry Trends',
                'category_slug' => 'industry-trends',
                'author' => 'R-CAT Team',
                'published_at' => '2025-07-05',
                'featured_image' => null,
                'is_featured' => 1,
                'tags' => []
            ]
        ];
        
        // Get featured posts (first 3 featured posts)
        $featuredPosts = array_filter($posts, function($post) {
            return $post['is_featured'] == 1;
        });
        $featuredPosts = array_slice($featuredPosts, 0, 3);
        
        // Empty pagination for static content
        $pagination = [
            'current_page' => 1,
            'total_pages' => 1,
            'has_next' => false,
            'has_prev' => false,
            'total_posts' => count($posts)
        ];
        
        $popularTags = [];
        
        // Load the blog view
        include __DIR__ . '/../Views/layouts/main.php';
    }
    
    public function post($slug = null) {
        try {
            if (!$slug) {
                header("Location: /blog");
                exit;
            }
            
            if ($this->blogDb) {
                // Get the blog post from database
                $post = $this->blogDb->getPostBySlug($slug);
                
                if (!$post) {
                    header("HTTP/1.0 404 Not Found");
                    $this->showErrorPage("Blog post not found.");
                    return;
                }
                
                // Get related posts
                $relatedPosts = $this->blogDb->getRelatedPosts($post['id'], $post['category_id'], 3);
                
                // Set page meta data
                $pageTitle = $post['meta_title'] ?: $post['title'] . " - R-CAT Rajasthan";
                $pageDescription = $post['meta_description'] ?: $post['excerpt'];
                $pageKeywords = $post['meta_keywords'] ?: '';
                
                // Generate article schema markup
                $articleSchemaData = [
                    "@context" => "https://schema.org",
                    "@type" => "Article",
                    "headline" => $post['title'],
                    "description" => $post['excerpt'],
                    "author" => [
                        "@type" => "Organization",
                        "name" => $post['author']
                    ],
                    "publisher" => [
                        "@type" => "Organization",
                        "name" => "R-CAT Rajasthan",
                        "logo" => [
                            "@type" => "ImageObject",
                            "url" => "https://rcatrajasthan.com/assets/images/logo.png"
                        ]
                    ],
                    "datePublished" => date('c', strtotime($post['published_at'])),
                    "dateModified" => date('c', strtotime($post['updated_at'])),
                    "url" => "https://rcatrajasthan.com/blog/" . $post['slug'],
                    "mainEntityOfPage" => "https://rcatrajasthan.com/blog/" . $post['slug']
                ];
                
                if ($post['featured_image']) {
                    $articleSchemaData['image'] = "https://rcatrajasthan.com" . $post['featured_image'];
                }
                
                // Load single post view
                include __DIR__ . '/../Views/pages/blog-post.php';
            } else {
                // Fallback - redirect to blog listing
                header("Location: /blog");
                exit;
            }
            
        } catch (Exception $e) {
            error_log("Blog Post Error: " . $e->getMessage());
            $this->showErrorPage("Sorry, we couldn't load this blog post.");
        }
    }
    
    public function category($slug = null) {
        try {
            if (!$slug) {
                header("Location: /blog");
                exit;
            }
            
            if ($this->blogDb) {
                // Get category
                $category = $this->blogDb->getCategoryBySlug($slug);
                
                if (!$category) {
                    header("HTTP/1.0 404 Not Found");
                    $this->showErrorPage("Category not found.");
                    return;
                }
            }
            
            // Redirect to blog with category filter
            header("Location: /blog?category=" . $slug);
            exit;
            
        } catch (Exception $e) {
            error_log("Blog Category Error: " . $e->getMessage());
            header("Location: /blog");
            exit;
        }
    }
    
    public function search() {
        try {
            $query = $_GET['q'] ?? $_GET['search'] ?? '';
            
            if (empty($query)) {
                header("Location: /blog");
                exit;
            }
            
            // Redirect to blog with search parameter
            header("Location: /blog?search=" . urlencode($query));
            exit;
            
        } catch (Exception $e) {
            error_log("Blog Search Error: " . $e->getMessage());
            header("Location: /blog");
            exit;
        }
    }
    
    private function showErrorPage($message) {
        $pageTitle = "Error - R-CAT Rajasthan";
        $pageDescription = "An error occurred while loading the page.";
        $pageKeywords = "";
        
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . htmlspecialchars($pageTitle) . '</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <h1>Oops!</h1>
                        <p class="lead">' . htmlspecialchars($message) . '</p>
                        <a href="/blog" class="btn btn-primary">Back to Blog</a>
                        <a href="/" class="btn btn-outline-secondary">Home</a>
                    </div>
                </div>
            </div>
        </body>
        </html>';
        exit;
    }
    
    // API method for AJAX requests (future use)
    public function api() {
        header('Content-Type: application/json');
        
        try {
            if (!$this->blogDb) {
                echo json_encode(['success' => false, 'message' => 'Database not available']);
                exit;
            }
            
            $action = $_GET['action'] ?? '';
            
            switch ($action) {
                case 'posts':
                    $filters = [
                        'limit' => min(20, intval($_GET['limit'] ?? 10)),
                        'offset' => max(0, intval($_GET['offset'] ?? 0))
                    ];
                    
                    if (!empty($_GET['category'])) {
                        $filters['category_slug'] = $_GET['category'];
                    }
                    
                    if (!empty($_GET['search'])) {
                        $filters['search'] = $_GET['search'];
                    }
                    
                    $posts = $this->blogDb->getPosts($filters);
                    echo json_encode(['success' => true, 'posts' => $posts]);
                    break;
                    
                case 'stats':
                    $stats = $this->blogDb->getBlogStats();
                    echo json_encode(['success' => true, 'stats' => $stats]);
                    break;
                    
                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid action']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }
}
?>
