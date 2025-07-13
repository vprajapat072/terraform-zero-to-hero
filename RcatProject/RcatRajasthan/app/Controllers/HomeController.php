<?php
require_once 'app/Config.php';

class HomeController {
    public function index() {
        $pageTitle = "Fast & Easy Guide to R-CAT Rajasthan";
        $pageDescription = "Get comprehensive information about R-CAT Rajasthan courses, admission process, and career opportunities. Your fastest resource for government skill development programs.";
        $pageKeywords = "R-CAT Rajasthan, RCAT courses, Rajasthan government courses, skill development, cloud computing, AI ML";
        
        // Get featured courses (mock data for now)
        $featuredCourses = [
            [
                'id' => 1,
                'name' => 'Cloud Computing',
                'description' => 'Master AWS, Azure, and Google Cloud platforms with hands-on projects and industry certification.',
                'duration' => '6 months',
                'fee' => '₹25,000',
                'image' => '/assets/images/cloud-computing.jpg',
                'slug' => 'cloud-computing',
                'category' => 'technology'
            ],
            [
                'id' => 2,
                'name' => 'Artificial Intelligence & Machine Learning',
                'description' => 'Learn AI/ML concepts, Python programming, and build real-world AI applications.',
                'duration' => '8 months',
                'fee' => '₹30,000',
                'image' => '/assets/images/ai-ml.jpg',
                'slug' => 'artificial-intelligence',
                'category' => 'technology'
            ],
            [
                'id' => 3,
                'name' => 'Cybersecurity',
                'description' => 'Become a cybersecurity expert with ethical hacking, network security, and compliance training.',
                'duration' => '5 months',
                'fee' => '₹20,000',
                'image' => '/assets/images/cybersecurity.jpg',
                'slug' => 'cybersecurity',
                'category' => 'security'
            ]
        ];
        
        // Get latest blog posts (mock data)
        $latestPosts = [
            [
                'title' => 'Top 5 Highest Paying Tech Skills in 2025',
                'excerpt' => 'Discover the most in-demand technical skills that offer the highest salary packages in the current market.',
                'date' => '2025-01-10',
                'slug' => 'highest-paying-tech-skills-2025',
                'image' => '/assets/images/blog-1.jpg'
            ],
            [
                'title' => 'Why Choose R-CAT for Your Career Growth',
                'excerpt' => 'Learn about the unique advantages of R-CAT programs and how they can accelerate your professional development.',
                'date' => '2025-01-08',
                'slug' => 'why-choose-rcat-career-growth',
                'image' => '/assets/images/blog-2.jpg'
            ]
        ];
        
        ob_start();
        include 'app/Views/pages/home.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

$controller = new HomeController();
$controller->index();
?>
