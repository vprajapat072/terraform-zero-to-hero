<?php
require_once 'app/Config.php';

class BlogController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        $pageTitle = "Blog - R-CAT Rajasthan";
        $pageDescription = "Stay updated with the latest career guidance, industry trends, and success stories from R-CAT Rajasthan. Read our expert insights and tips.";
        $pageKeywords = "R-CAT blog, career guidance, industry trends, technology news, skill development tips, success stories";
        
        // Get blog categories
        $categoryQuery = "SELECT * FROM blog_categories WHERE is_active = 1 ORDER BY sort_order";
        $categories = $this->pdo->query($categoryQuery)->fetchAll();
        
        // Get published blog posts
        $postQuery = "
            SELECT bp.*, bc.name as category_name, bc.slug as category_slug, u.username as author_name
            FROM blog_posts bp 
            LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
            LEFT JOIN users u ON bp.author_id = u.id
            WHERE bp.status = 'published' 
            ORDER BY bp.published_at DESC 
            LIMIT 12
        ";
        $posts = $this->pdo->query($postQuery)->fetchAll();
        
        // Get featured posts
        $featuredQuery = "
            SELECT bp.*, bc.name as category_name, bc.slug as category_slug, u.username as author_name
            FROM blog_posts bp 
            LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
            LEFT JOIN users u ON bp.author_id = u.id
            WHERE bp.status = 'published' AND bp.views > 100
            ORDER BY bp.views DESC 
            LIMIT 3
        ";
        $featuredPosts = $this->pdo->query($featuredQuery)->fetchAll();
        
        // Mock data for demonstration
        if (empty($posts)) {
            $posts = [
                [
                    'id' => 1,
                    'title' => 'Top 5 Highest Paying Tech Skills in 2025',
                    'slug' => 'highest-paying-tech-skills-2025',
                    'excerpt' => 'Discover the most in-demand technical skills that offer the highest salary packages in the current market.',
                    'published_at' => '2025-01-10',
                    'category_name' => 'Career Guidance',
                    'category_slug' => 'career-guidance',
                    'author_name' => 'Admin',
                    'views' => 150
                ],
                [
                    'id' => 2,
                    'title' => 'Why Choose R-CAT for Your Career Growth',
                    'slug' => 'why-choose-rcat-career-growth',
                    'excerpt' => 'Learn about the unique advantages of R-CAT programs and how they can accelerate your professional development.',
                    'published_at' => '2025-01-08',
                    'category_name' => 'Career Guidance',
                    'category_slug' => 'career-guidance',
                    'author_name' => 'Admin',
                    'views' => 120
                ],
                [
                    'id' => 3,
                    'title' => 'Cloud Computing Trends to Watch in 2025',
                    'slug' => 'cloud-computing-trends-2025',
                    'excerpt' => 'Stay ahead of the curve with these emerging cloud computing trends that will shape the industry.',
                    'published_at' => '2025-01-05',
                    'category_name' => 'Industry Trends',
                    'category_slug' => 'industry-trends',
                    'author_name' => 'Admin',
                    'views' => 200
                ],
                [
                    'id' => 4,
                    'title' => 'From Student to Software Engineer: A Success Story',
                    'slug' => 'student-to-software-engineer-success',
                    'excerpt' => 'Read how Rajesh transformed his career from a college graduate to a successful software engineer.',
                    'published_at' => '2025-01-03',
                    'category_name' => 'Success Stories',
                    'category_slug' => 'success-stories',
                    'author_name' => 'Admin',
                    'views' => 180
                ],
                [
                    'id' => 5,
                    'title' => 'Cybersecurity Fundamentals Every Professional Should Know',
                    'slug' => 'cybersecurity-fundamentals-2025',
                    'excerpt' => 'Essential cybersecurity knowledge that every IT professional should master in today\'s digital world.',
                    'published_at' => '2025-01-01',
                    'category_name' => 'Technology News',
                    'category_slug' => 'technology-news',
                    'author_name' => 'Admin',
                    'views' => 95
                ],
                [
                    'id' => 6,
                    'title' => 'How to Choose the Right Tech Course for Your Career',
                    'slug' => 'choose-right-tech-course-career',
                    'excerpt' => 'A comprehensive guide to selecting the perfect technology course based on your career goals and interests.',
                    'published_at' => '2024-12-28',
                    'category_name' => 'Career Guidance',
                    'category_slug' => 'career-guidance',
                    'author_name' => 'Admin',
                    'views' => 130
                ]
            ];
        }
        
        if (empty($categories)) {
            $categories = [
                ['id' => 1, 'name' => 'Career Guidance', 'slug' => 'career-guidance'],
                ['id' => 2, 'name' => 'Industry Trends', 'slug' => 'industry-trends'],
                ['id' => 3, 'name' => 'Success Stories', 'slug' => 'success-stories'],
                ['id' => 4, 'name' => 'Technology News', 'slug' => 'technology-news'],
                ['id' => 5, 'name' => 'Course Updates', 'slug' => 'course-updates']
            ];
        }
        
        if (empty($featuredPosts)) {
            $featuredPosts = array_slice($posts, 0, 3);
        }
        
        ob_start();
        include 'app/Views/pages/blog.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

$controller = new BlogController();
$controller->index();
?>
