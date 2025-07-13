<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Database;
use CodeIgniter\Exceptions\PageNotFoundException;

class Blog extends Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::connect();
    }
    
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $category = $this->request->getGet('category');
        $search = $this->request->getGet('search');
        $limit = 9;
        $offset = ($page - 1) * $limit;
        
        // Build query conditions
        $whereConditions = ['status = "published"'];
        $params = [];
        
        if ($category) {
            $whereConditions[] = 'category = ?';
            $params[] = $category;
        }
        
        if ($search) {
            $whereConditions[] = '(title LIKE ? OR content LIKE ? OR excerpt LIKE ?)';
            $searchTerm = '%' . $search . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        $whereClause = implode(' AND ', $whereConditions);
        
        // Get blog posts
        $query = "SELECT * FROM blog_posts WHERE {$whereClause} ORDER BY created_at DESC LIMIT {$limit} OFFSET {$offset}";
        $posts = $this->db->query($query, $params)->getResultArray();
        
        // Get total count for pagination
        $countQuery = "SELECT COUNT(*) as total FROM blog_posts WHERE {$whereClause}";
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
        // Get the blog post
        $post = $this->db->query('SELECT * FROM blog_posts WHERE slug = ? AND status = "published"', [$slug])->getRowArray();
        
        if (!$post) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        // Get related posts
        $relatedPosts = $this->db->query(
            'SELECT title, slug, excerpt, featured_image FROM blog_posts 
             WHERE category = ? AND slug != ? AND status = "published" 
             ORDER BY created_at DESC LIMIT 3',
            [$post['category'], $slug]
        )->getResultArray();
        
        // SEO Data
        $pageTitle = $post['title'] . ' - R-CAT Blog';
        $pageDescription = $post['excerpt'];
        $pageKeywords = $post['tags'];
        
        // Load SEO helper for schema markup
        helper('SEO');
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
            $result = $this->db->query('SELECT DISTINCT category FROM blog_posts WHERE status = "published" AND category IS NOT NULL ORDER BY category')->getResultArray();
            return array_column($result, 'category');
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
            "datePublished" => date('c', strtotime($post['created_at'])),
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
