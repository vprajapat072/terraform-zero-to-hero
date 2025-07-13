<?php
require_once 'app/Config.php';

class CoursesController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        $pageTitle = "All Courses - R-CAT Rajasthan";
        $pageDescription = "Browse all available courses at R-CAT Rajasthan including Cloud Computing, AI/ML, Cybersecurity, and more technical programs.";
        $pageKeywords = "R-CAT courses, RCAT all courses, Rajasthan technical courses, cloud computing, AI ML, cybersecurity";
        
        // Get all course categories
        $categoryQuery = "SELECT * FROM course_categories WHERE is_active = 1 ORDER BY sort_order";
        $categories = $this->pdo->query($categoryQuery)->fetchAll();
        
        // Get all active courses with categories
        $courseQuery = "
            SELECT c.*, cc.name as category_name, cc.slug as category_slug 
            FROM courses c 
            LEFT JOIN course_categories cc ON c.category_id = cc.id 
            WHERE c.is_active = 1 
            ORDER BY c.sort_order, c.name
        ";
        $courses = $this->pdo->query($courseQuery)->fetchAll();
        
        // Get featured courses
        $featuredQuery = "
            SELECT c.*, cc.name as category_name, cc.slug as category_slug 
            FROM courses c 
            LEFT JOIN course_categories cc ON c.category_id = cc.id 
            WHERE c.is_active = 1 AND c.is_featured = 1 
            ORDER BY c.sort_order 
            LIMIT 6
        ";
        $featuredCourses = $this->pdo->query($featuredQuery)->fetchAll();
        
        // Mock data for demonstration
        if (empty($courses)) {
            $courses = [
                [
                    'id' => 1,
                    'name' => 'Cloud Computing',
                    'slug' => 'cloud-computing',
                    'short_description' => 'Master AWS, Azure, and Google Cloud platforms with hands-on projects and industry certification.',
                    'duration' => '6 months',
                    'fee' => '₹25,000',
                    'category_name' => 'Technology',
                    'category_slug' => 'technology',
                    'is_featured' => 1
                ],
                [
                    'id' => 2,
                    'name' => 'Artificial Intelligence & Machine Learning',
                    'slug' => 'artificial-intelligence',
                    'short_description' => 'Learn AI/ML concepts, Python programming, and build real-world AI applications.',
                    'duration' => '8 months',
                    'fee' => '₹30,000',
                    'category_name' => 'Technology',
                    'category_slug' => 'technology',
                    'is_featured' => 1
                ],
                [
                    'id' => 3,
                    'name' => 'Cybersecurity',
                    'slug' => 'cybersecurity',
                    'short_description' => 'Become a cybersecurity expert with ethical hacking, network security, and compliance training.',
                    'duration' => '5 months',
                    'fee' => '₹20,000',
                    'category_name' => 'Security',
                    'category_slug' => 'security',
                    'is_featured' => 1
                ],
                [
                    'id' => 4,
                    'name' => 'Web Development',
                    'slug' => 'web-development',
                    'short_description' => 'Full-stack web development with modern frameworks and technologies.',
                    'duration' => '4 months',
                    'fee' => '₹18,000',
                    'category_name' => 'Technology',
                    'category_slug' => 'technology',
                    'is_featured' => 0
                ],
                [
                    'id' => 5,
                    'name' => 'Data Science',
                    'slug' => 'data-science',
                    'short_description' => 'Comprehensive data science program covering analytics, visualization, and machine learning.',
                    'duration' => '7 months',
                    'fee' => '₹28,000',
                    'category_name' => 'Data Science',
                    'category_slug' => 'data-science',
                    'is_featured' => 0
                ],
                [
                    'id' => 6,
                    'name' => 'Digital Marketing',
                    'slug' => 'digital-marketing',
                    'short_description' => 'Master digital marketing strategies, SEO, social media, and online advertising.',
                    'duration' => '3 months',
                    'fee' => '₹15,000',
                    'category_name' => 'Marketing',
                    'category_slug' => 'marketing',
                    'is_featured' => 0
                ]
            ];
        }
        
        if (empty($categories)) {
            $categories = [
                ['id' => 1, 'name' => 'Technology', 'slug' => 'technology'],
                ['id' => 2, 'name' => 'Security', 'slug' => 'security'],
                ['id' => 3, 'name' => 'Data Science', 'slug' => 'data-science'],
                ['id' => 4, 'name' => 'Marketing', 'slug' => 'marketing']
            ];
        }
        
        if (empty($featuredCourses)) {
            $featuredCourses = array_slice($courses, 0, 3);
        }
        
        ob_start();
        include 'app/Views/pages/courses.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

$controller = new CoursesController();
$controller->index();
?>
