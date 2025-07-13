<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Database;
use CodeIgniter\Exceptions\PageNotFoundException;

class CourseDetailController extends Controller
{
    public function index($slug)
    {
        $db = Database::connect();
        
        $course = $db->query('SELECT * FROM courses WHERE slug = ? AND is_active = 1', [$slug])->getRowArray();
        
        if (!$course) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        // Decode JSON fields
        $course['curriculum'] = json_decode($course['curriculum'] ?? '[]', true);
        $course['features'] = json_decode($course['features'] ?? '[]', true);
        $course['eligibility'] = json_decode($course['eligibility'] ?? '[]', true);
        $course['career_opportunities'] = json_decode($course['career_opportunities'] ?? '[]', true);
        
        // SEO Data
        $pageTitle = $course['title'] . ' Course - R-CAT Rajasthan';
        $pageDescription = $course['description'];
        $pageKeywords = $course['keywords'];
        
        // Generate course schema markup
        helper('SEO');
        $schema_markup = generate_course_schema($course);
        
        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => base_url()],
            ['name' => 'Courses', 'url' => base_url('courses')],
            ['name' => $course['title'], 'url' => current_url()]
        ];
        
        return view('layouts/main', [
            'content' => view('pages/course-detail', ['course' => $course]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords,
            'schema_markup' => $schema_markup,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
    
    private function getCourseBySlug($slug) {
        // Mock course data for demonstration
        $courses = [
            'cloud-computing' => [
                'id' => 1,
                'title' => 'Cloud Computing Certification',
                'slug' => 'cloud-computing',
                'description' => 'Master cloud technologies with AWS, Azure, and Google Cloud Platform. Learn to design, deploy, and manage scalable cloud solutions.',
                'keywords' => 'cloud computing, AWS, Azure, GCP, cloud certification, R-CAT',
                'image' => '/assets/images/courses/cloud-computing.jpg',
                'duration' => '6 months',
                'fee' => '₹25,000',
                'level' => 'Beginner to Advanced',
                'certification' => 'R-CAT Certified Cloud Professional',
                'partner' => 'Amazon Web Services',
                'overview' => 'This comprehensive cloud computing course covers all major cloud platforms and technologies. You\'ll learn to design, implement, and manage cloud infrastructure, develop cloud-native applications, and ensure security and compliance in cloud environments.',
                'curriculum' => [
                    'Cloud Fundamentals & Architecture',
                    'Amazon Web Services (AWS)',
                    'Microsoft Azure',
                    'Google Cloud Platform',
                    'Cloud Security & Compliance',
                    'DevOps & Cloud Automation',
                    'Serverless Computing',
                    'Cloud Migration Strategies'
                ],
                'features' => [
                    'Hands-on labs with real cloud environments',
                    'Industry-standard certification preparation',
                    'Expert instructors with cloud experience',
                    'Career placement assistance',
                    'Lifetime access to course materials',
                    'Monthly webinars and updates'
                ],
                'eligibility' => [
                    'Basic understanding of computers and networking',
                    'Graduate in any discipline',
                    'Working professionals looking to upskill',
                    'Fresh graduates seeking cloud careers'
                ],
                'career_opportunities' => [
                    'Cloud Solutions Architect',
                    'Cloud Engineer',
                    'DevOps Engineer',
                    'Cloud Security Specialist',
                    'Cloud Consultant',
                    'Systems Administrator'
                ]
            ],
            'ai-machine-learning' => [
                'id' => 2,
                'title' => 'AI & Machine Learning Certification',
                'slug' => 'ai-machine-learning',
                'description' => 'Dive deep into artificial intelligence and machine learning algorithms. Build intelligent systems and predictive models.',
                'keywords' => 'AI, machine learning, deep learning, neural networks, R-CAT',
                'image' => '/assets/images/courses/ai-ml.jpg',
                'duration' => '8 months',
                'fee' => '₹30,000',
                'level' => 'Intermediate to Advanced',
                'certification' => 'R-CAT Certified AI/ML Professional',
                'partner' => 'Google AI',
                'overview' => 'Explore the fascinating world of artificial intelligence and machine learning. This course covers everything from basic algorithms to advanced deep learning techniques, preparing you for the AI revolution.',
                'curriculum' => [
                    'Introduction to AI & ML',
                    'Python for Data Science',
                    'Statistics & Probability',
                    'Machine Learning Algorithms',
                    'Deep Learning & Neural Networks',
                    'Natural Language Processing',
                    'Computer Vision',
                    'AI Ethics & Deployment'
                ],
                'features' => [
                    'Real-world projects and case studies',
                    'Access to GPU-powered cloud platforms',
                    'Industry mentorship program',
                    'Portfolio development guidance',
                    'Job placement support',
                    'Continuous learning resources'
                ],
                'eligibility' => [
                    'Bachelor\'s degree in Engineering/Science/IT',
                    'Basic programming knowledge (Python preferred)',
                    'Strong mathematical foundation',
                    'Passion for technology and innovation'
                ],
                'career_opportunities' => [
                    'Machine Learning Engineer',
                    'Data Scientist',
                    'AI Research Scientist',
                    'Deep Learning Engineer',
                    'AI Product Manager',
                    'Computer Vision Engineer'
                ]
            ],
            'cybersecurity' => [
                'id' => 3,
                'title' => 'Cybersecurity Certification',
                'slug' => 'cybersecurity',
                'description' => 'Protect digital assets with advanced security skills. Learn ethical hacking, network security, and cybersecurity frameworks.',
                'keywords' => 'cybersecurity, ethical hacking, network security, information security, R-CAT',
                'image' => '/assets/images/courses/cybersecurity.jpg',
                'duration' => '7 months',
                'fee' => '₹28,000',
                'level' => 'Beginner to Advanced',
                'certification' => 'R-CAT Certified Security Professional',
                'partner' => 'EC-Council',
                'overview' => 'In today\'s digital world, cybersecurity is crucial. This comprehensive course covers all aspects of information security, from basic concepts to advanced threat detection and response strategies.',
                'curriculum' => [
                    'Information Security Fundamentals',
                    'Network Security',
                    'Ethical Hacking & Penetration Testing',
                    'Security Frameworks & Compliance',
                    'Incident Response & Forensics',
                    'Cloud Security',
                    'Mobile & IoT Security',
                    'Security Operations Center (SOC)'
                ],
                'features' => [
                    'Virtual hacking labs',
                    'Industry-standard security tools',
                    'Practical exercises and simulations',
                    'Expert-led workshops',
                    'Career guidance and placement',
                    'Certification exam preparation'
                ],
                'eligibility' => [
                    'Graduate in any discipline',
                    'Basic understanding of computers and networks',
                    'Interest in security and technology',
                    'Problem-solving mindset'
                ],
                'career_opportunities' => [
                    'Cybersecurity Analyst',
                    'Security Engineer',
                    'Penetration Tester',
                    'Security Consultant',
                    'Incident Response Specialist',
                    'Security Architect'
                ]
            ]
        ];
        
        return $courses[$slug] ?? null;
    }
}

$controller = new CourseDetailController();
$controller->index();
?>
