<?php
require_once 'app/Config.php';

class AboutController {
    public function index() {
        $pageTitle = "About R-CAT Rajasthan";
        $pageDescription = "Learn about R-CAT Rajasthan, its mission, vision, and commitment to providing quality technical education and skill development programs.";
        $pageKeywords = "R-CAT Rajasthan about, RCAT mission vision, Rajasthan government training, skill development center";
        
        // Get about page content from database (mock for now)
        $aboutContent = [
            'mission' => 'To provide world-class technical education and skill development programs that bridge the gap between academic knowledge and industry requirements.',
            'vision' => 'To become the leading center of excellence for technical education in Rajasthan and contribute to the digital transformation of the state.',
            'established' => '2018',
            'students_trained' => '10,000+',
            'courses_offered' => '50+',
            'industry_partners' => '500+',
            'placement_rate' => '95%'
        ];
        
        // Leadership team
        $leadership = [
            [
                'name' => 'Dr. Rajesh Kumar',
                'position' => 'Director',
                'image' => '/assets/images/team/director.jpg',
                'bio' => 'Dr. Kumar has over 20 years of experience in technical education and has been instrumental in establishing R-CAT as a premier institution.'
            ],
            [
                'name' => 'Prof. Sunita Sharma',
                'position' => 'Academic Head',
                'image' => '/assets/images/team/academic-head.jpg',
                'bio' => 'Prof. Sharma specializes in curriculum development and has designed many of the innovative courses at R-CAT.'
            ],
            [
                'name' => 'Mr. Amit Gupta',
                'position' => 'Training Head',
                'image' => '/assets/images/team/training-head.jpg',
                'bio' => 'Mr. Gupta leads the practical training programs and maintains strong industry partnerships.'
            ]
        ];
        
        // Key achievements
        $achievements = [
            [
                'year' => '2024',
                'title' => 'Excellence in Technical Education Award',
                'description' => 'Recognized by the Government of Rajasthan for outstanding contribution to skill development.'
            ],
            [
                'year' => '2023',
                'title' => 'Best Industry Partnership',
                'description' => 'Awarded for successful collaborations with major technology companies.'
            ],
            [
                'year' => '2022',
                'title' => 'Digital Innovation Award',
                'description' => 'Recognized for pioneering online and hybrid learning models.'
            ]
        ];
        
        ob_start();
        include 'app/Views/pages/about.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

$controller = new AboutController();
$controller->index();
?>
