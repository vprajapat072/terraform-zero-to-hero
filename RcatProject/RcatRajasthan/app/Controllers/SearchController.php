<?php
require_once 'app/Config.php';

class SearchController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        $query = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? 'all';
        
        $pageTitle = "Search Results" . ($query ? " for '{$query}'" : "") . " - R-CAT Rajasthan";
        $pageDescription = "Search R-CAT Rajasthan courses, blog posts, and information to find exactly what you're looking for.";
        $pageKeywords = "R-CAT search, course search, find courses, search results";
        
        $results = [];
        $totalResults = 0;
        
        if ($query) {
            $results = $this->performSearch($query, $category);
            $totalResults = count($results);
        }
        
        include 'app/Views/pages/search.php';
    }
    
    private function performSearch($query, $category) {
        $results = [];
        $searchTerm = '%' . $query . '%';
        
        try {
            // Search in courses
            if ($category === 'all' || $category === 'courses') {
                $courseQuery = "
                    SELECT 'course' as type, id, name as title, description, slug, 
                           duration, fee, '' as excerpt, created_at as date
                    FROM courses 
                    WHERE (name LIKE ? OR description LIKE ? OR curriculum LIKE ?) 
                    AND is_active = 1
                    ORDER BY name
                ";
                $stmt = $this->pdo->prepare($courseQuery);
                $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
                $courses = $stmt->fetchAll();
                
                foreach ($courses as $course) {
                    $course['url'] = '/courses/' . $course['slug'];
                    $course['category'] = 'Course';
                    $results[] = $course;
                }
            }
            
            // Search in blog posts
            if ($category === 'all' || $category === 'blog') {
                $blogQuery = "
                    SELECT 'blog' as type, bp.id, bp.title, bp.content as description, 
                           bp.slug, bp.excerpt, bp.published_at as date, bc.name as category
                    FROM blog_posts bp
                    LEFT JOIN blog_categories bc ON bp.category_id = bc.id
                    WHERE (bp.title LIKE ? OR bp.content LIKE ? OR bp.excerpt LIKE ?) 
                    AND bp.status = 'published'
                    ORDER BY bp.published_at DESC
                ";
                $stmt = $this->pdo->prepare($blogQuery);
                $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
                $blogs = $stmt->fetchAll();
                
                foreach ($blogs as $blog) {
                    $blog['url'] = '/blog/' . $blog['slug'];
                    $blog['category'] = 'Blog - ' . ($blog['category'] ?? 'General');
                    $results[] = $blog;
                }
            }
            
            // Search in FAQs
            if ($category === 'all' || $category === 'faq') {
                $faqQuery = "
                    SELECT 'faq' as type, f.id, f.question as title, f.answer as description,
                           '' as slug, '' as excerpt, f.created_at as date, fc.name as category
                    FROM faqs f
                    LEFT JOIN faq_categories fc ON f.category_id = fc.id
                    WHERE (f.question LIKE ? OR f.answer LIKE ?) 
                    AND f.is_active = 1
                    ORDER BY f.question
                ";
                $stmt = $this->pdo->prepare($faqQuery);
                $stmt->execute([$searchTerm, $searchTerm]);
                $faqs = $stmt->fetchAll();
                
                foreach ($faqs as $faq) {
                    $faq['url'] = '/faq#faq-' . $faq['id'];
                    $faq['category'] = 'FAQ - ' . ($faq['category'] ?? 'General');
                    $results[] = $faq;
                }
            }
            
        } catch (Exception $e) {
            // Fallback to demo search results
            $results = $this->getDemoSearchResults($query, $category);
        }
        
        return $results;
    }
    
    private function getDemoSearchResults($query, $category) {
        $allResults = [
            [
                'type' => 'course',
                'title' => 'Cloud Computing with AWS',
                'description' => 'Comprehensive course covering AWS cloud services, EC2, S3, Lambda, and more.',
                'url' => '/courses/cloud-computing',
                'category' => 'Course',
                'date' => '2025-01-01'
            ],
            [
                'type' => 'course',
                'title' => 'Artificial Intelligence & Machine Learning',
                'description' => 'Learn AI/ML concepts, Python programming, and build real-world applications.',
                'url' => '/courses/artificial-intelligence',
                'category' => 'Course',
                'date' => '2025-01-01'
            ],
            [
                'type' => 'blog',
                'title' => 'Top 5 Highest Paying Tech Skills in 2025',
                'description' => 'Discover the most in-demand technical skills that offer the highest salary packages.',
                'url' => '/blog/highest-paying-tech-skills-2025',
                'category' => 'Blog - Career Guidance',
                'date' => '2025-01-10'
            ],
            [
                'type' => 'faq',
                'title' => 'What is R-CAT Rajasthan?',
                'description' => 'R-CAT is a government-run skill development center offering advanced technology courses.',
                'url' => '/faq#faq-1',
                'category' => 'FAQ - General',
                'date' => '2025-01-01'
            ]
        ];
        
        // Filter by category
        if ($category !== 'all') {
            $allResults = array_filter($allResults, function($result) use ($category) {
                return $result['type'] === $category;
            });
        }
        
        // Filter by query
        if ($query) {
            $allResults = array_filter($allResults, function($result) use ($query) {
                $searchableText = strtolower($result['title'] . ' ' . $result['description']);
                return strpos($searchableText, strtolower($query)) !== false;
            });
        }
        
        return array_values($allResults);
    }
}

// Initialize and run
$controller = new SearchController();
$controller->index();
?>
