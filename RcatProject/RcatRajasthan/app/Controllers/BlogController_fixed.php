<?php
// Simple Blog Controller without database dependency

class BlogController {
    
    public function index() {
        $pageTitle = "Blog - R-CAT Rajasthan";
        $pageDescription = "Stay updated with the latest career guidance, industry trends, and success stories from R-CAT Rajasthan. Read our expert insights and tips.";
        $pageKeywords = "R-CAT blog, career guidance, industry trends, technology news, skill development tips, success stories";
        
        // Sample blog categories (static for now)
        $categories = [
            ['id' => 1, 'name' => 'Career Guidance', 'slug' => 'career-guidance'],
            ['id' => 2, 'name' => 'Industry Trends', 'slug' => 'industry-trends'],
            ['id' => 3, 'name' => 'Success Stories', 'slug' => 'success-stories'],
            ['id' => 4, 'name' => 'Course Updates', 'slug' => 'course-updates']
        ];
        
        // Sample blog posts (static for now)
        $posts = [
            [
                'id' => 1,
                'title' => 'Top 10 Highest Paying Tech Jobs in Rajasthan 2025',
                'slug' => 'top-paying-tech-jobs-rajasthan-2025',
                'excerpt' => 'Discover the most lucrative technology careers available in Rajasthan and how R-CAT courses can help you achieve them.',
                'category_name' => 'Career Guidance',
                'category_slug' => 'career-guidance',
                'author_name' => 'R-CAT Team',
                'published_at' => '2025-07-10',
                'featured_image' => '/assets/images/blog/tech-jobs-rajasthan.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Cloud Computing Career Path: From Beginner to Expert',
                'slug' => 'cloud-computing-career-path',
                'excerpt' => 'Complete roadmap for building a successful career in cloud computing with AWS, Azure, and Google Cloud certifications.',
                'category_name' => 'Career Guidance',
                'category_slug' => 'career-guidance',
                'author_name' => 'R-CAT Team',
                'published_at' => '2025-07-08',
                'featured_image' => '/assets/images/blog/cloud-career.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Why Rajasthan is Becoming India\'s Next Tech Hub',
                'slug' => 'rajasthan-emerging-tech-hub',
                'excerpt' => 'Explore how Rajasthan is transforming into a major technology destination and the opportunities it creates for IT professionals.',
                'category_name' => 'Industry Trends',
                'category_slug' => 'industry-trends',
                'author_name' => 'R-CAT Team',
                'published_at' => '2025-07-05',
                'featured_image' => '/assets/images/blog/rajasthan-tech-hub.jpg'
            ],
            [
                'id' => 4,
                'title' => 'Success Story: From Graduate to AWS Solutions Architect',
                'slug' => 'success-story-aws-architect',
                'excerpt' => 'Read how Priya Sharma transformed her career from a recent graduate to a certified AWS Solutions Architect earning ₹12 LPA.',
                'category_name' => 'Success Stories',
                'category_slug' => 'success-stories',
                'author_name' => 'R-CAT Team',
                'published_at' => '2025-07-03',
                'featured_image' => '/assets/images/blog/success-story-aws.jpg'
            ],
            [
                'id' => 5,
                'title' => 'New Batch Starting: Ethical Hacking & Cybersecurity',
                'slug' => 'new-batch-ethical-hacking',
                'excerpt' => 'Join our comprehensive 8-month Ethical Hacking and Cybersecurity program starting August 2025. Limited seats available.',
                'category_name' => 'Course Updates',
                'category_slug' => 'course-updates',
                'author_name' => 'R-CAT Team',
                'published_at' => '2025-07-01',
                'featured_image' => '/assets/images/blog/ethical-hacking-course.jpg'
            ],
            [
                'id' => 6,
                'title' => 'AI and Machine Learning Trends in 2025',
                'slug' => 'ai-ml-trends-2025',
                'excerpt' => 'Discover the latest trends in artificial intelligence and machine learning that will shape the technology landscape in 2025.',
                'category_name' => 'Industry Trends',
                'category_slug' => 'industry-trends',
                'author_name' => 'R-CAT Team',
                'published_at' => '2025-06-28',
                'featured_image' => '/assets/images/blog/ai-ml-trends.jpg'
            ]
        ];
        
        // Featured posts (first 3 posts)
        $featuredPosts = array_slice($posts, 0, 3);
        
        // Total posts count
        $totalPosts = count($posts);
        
        // Recent posts (last 4 posts)
        $recentPosts = array_slice(array_reverse($posts), 0, 4);
        
        // Popular categories
        $popularCategories = [
            ['id' => 1, 'name' => 'Career Guidance', 'slug' => 'career-guidance'],
            ['id' => 2, 'name' => 'Industry Trends', 'slug' => 'industry-trends'],
            ['id' => 3, 'name' => 'Success Stories', 'slug' => 'success-stories'],
            ['id' => 4, 'name' => 'Technology News', 'slug' => 'technology-news'],
            ['id' => 5, 'name' => 'Course Updates', 'slug' => 'course-updates']
        ];
        
        // Include the layout with content
        ob_start();
        include 'app/Views/pages/blog.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

$controller = new BlogController();
$controller->index();
?>
