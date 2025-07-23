<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;
use CodeIgniter\Exceptions\PageNotFoundException;

class BlogNew extends Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $category = $this->request->getGet('category');
        $search = $this->request->getGet('search');
        $limit = 9;
        $offset = ($page - 1) * $limit;
        
        // Build query conditions
        $whereConditions = ['bp.status = "published"'];
        $params = [];
        
        if ($category) {
            $whereConditions[] = 'bc.slug = ?';
            $params[] = $category;
        }
        
        if ($search) {
            $whereConditions[] = '(bp.title LIKE ? OR bp.content LIKE ? OR bp.excerpt LIKE ?)';
            $searchTerm = '%' . $search . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        $whereClause = implode(' AND ', $whereConditions);
        
        // Get blog posts with category information
        $query = "SELECT bp.*, bc.name as category_name, bc.slug as category_slug 
                  FROM blog_posts bp 
                  LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
                  WHERE {$whereClause} 
                  ORDER BY bp.published_at DESC, bp.created_at DESC 
                  LIMIT {$limit} OFFSET {$offset}";
        $posts = $this->db->query($query, $params)->getResultArray();
        
        // Get total count for pagination
        $countQuery = "SELECT COUNT(*) as total 
                       FROM blog_posts bp 
                       LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
                       WHERE {$whereClause}";
        $totalPosts = $this->db->query($countQuery, $params)->getRow()->total;
        
        // Get categories for filter
        $categories = $this->getUniqueCategories();
        
        // Pagination data
        $totalPages = ceil($totalPosts / $limit);
        
        // SEO Data
        $pageTitle = $search ? "Search Results for '{$search}' - R-CAT Blog" : 
                    ($category ? ucfirst($category) . " Articles - R-CAT Blog" : "Blog - R-CAT Rajasthan");
        $pageDescription = "Stay updated with the latest career guidance, industry trends, and success stories from R-CAT Rajasthan. Expert insights on technology, career development, and skill building.";
        $pageKeywords = "R-CAT blog, career guidance, industry trends, technology news, skill development tips, success stories";
        
        return view('layouts/main', [
            'content' => view('pages/blog', [
                'posts' => $posts,
                'categories' => $categories,
                'current_category' => $category,
                'search_term' => $search,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_posts' => $totalPosts
            ]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords
        ]);
    }
    
    public function post($slug)
    {
        // Get the blog post with category information
        $post = $this->db->query(
            'SELECT bp.*, bc.name as category_name, bc.slug as category_slug 
             FROM blog_posts bp 
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
             WHERE bp.slug = ? AND bp.status = "published"', 
            [$slug]
        )->getRowArray();
        
        if (!$post) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        // Increment view count
        $this->db->query('UPDATE blog_posts SET view_count = view_count + 1 WHERE id = ?', [$post['id']]);
        
        // Get related posts
        $relatedPosts = $this->db->query(
            'SELECT bp.title, bp.slug, bp.excerpt, bp.featured_image, bc.name as category_name 
             FROM blog_posts bp 
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
             WHERE bp.category_id = ? AND bp.slug != ? AND bp.status = "published" 
             ORDER BY bp.published_at DESC, bp.created_at DESC LIMIT 3',
            [$post['category_id'], $slug]
        )->getResultArray();
        
        // SEO Data
        $pageTitle = !empty($post['meta_title']) ? $post['meta_title'] : $post['title'] . ' - R-CAT Blog';
        $pageDescription = !empty($post['meta_description']) ? $post['meta_description'] : $post['excerpt'];
        $pageKeywords = !empty($post['meta_keywords']) ? $post['meta_keywords'] : $post['category_name'];
        
        // Generate schema markup
        $schema_markup = $this->generateArticleSchema($post);
        
        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => base_url()],
            ['name' => 'Blog', 'url' => base_url('blog')],
            ['name' => $post['title'], 'url' => current_url()]
        ];
        
        return view('layouts/main', [
            'content' => view('pages/blog-post', [
                'post' => $post,
                'related_posts' => $relatedPosts
            ]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords,
            'schema_markup' => $schema_markup,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
    
    private function getUniqueCategories()
    {
        try {
            $result = $this->db->query('SELECT name, slug FROM blog_categories WHERE is_active = 1 ORDER BY sort_order, name')->getResultArray();
            return $result;
        } catch (Exception $e) {
            return [];
        }
    }
    
    private function generateArticleSchema($post)
    {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $post['title'],
            "description" => $post['excerpt'],
            "author" => [
                "@type" => "Person",
                "name" => $post['author'] ?? "R-CAT Team"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "R-CAT Rajasthan",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => base_url('assets/images/logo.png')
                ]
            ],
            "datePublished" => date('c', strtotime($post['published_at'] ?? $post['created_at'])),
            "dateModified" => date('c', strtotime($post['updated_at'])),
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => current_url()
            ]
        ];
        
        if (!empty($post['featured_image'])) {
            $schema['image'] = [
                "@type" => "ImageObject",
                "url" => base_url($post['featured_image'])
            ];
        }
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT) . '</script>';
    }
}
