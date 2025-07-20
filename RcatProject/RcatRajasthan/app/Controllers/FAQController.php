<?php
require_once 'app/Config.php';

class FAQController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        $pageTitle = "Frequently Asked Questions - R-CAT Rajasthan";
        $pageDescription = "Find answers to commonly asked questions about R-CAT courses, admission process, fees, eligibility, and more.";
        $pageKeywords = "R-CAT FAQ, RCAT questions, admission help, course information, eligibility requirements";
        
        // Sample FAQ categories (static for now)
        $categories = [
            ['id' => 1, 'name' => 'General Information', 'slug' => 'general'],
            ['id' => 2, 'name' => 'Admission Process', 'slug' => 'admission'],
            ['id' => 3, 'name' => 'Courses & Curriculum', 'slug' => 'courses'],
            ['id' => 4, 'name' => 'Fees & Payment', 'slug' => 'fees'],
            ['id' => 5, 'name' => 'Placement & Career', 'slug' => 'placement']
        ];
        
        // Sample FAQs (static for now, can be moved to database later)
        $allFaqs = [
            [
                'id' => 1,
                'category_id' => 1,
                'category_name' => 'General Information',
                'category_slug' => 'general',
                'question' => 'What is R-CAT Rajasthan?',
                'answer' => 'Rajiv Gandhi Centre of Advanced Technology (R-CAT) is a government-run skill development center in Rajasthan that offers advanced technology courses in areas like Cloud Computing, AI/ML, Cybersecurity, and more.'
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'category_name' => 'Admission Process',
                'category_slug' => 'admission',
                'question' => 'How do I apply for R-CAT courses?',
                'answer' => 'You can apply online through our website or visit our center directly. The admission process includes document verification and a brief interview.'
            ],
            [
                'id' => 3,
                'category_id' => 3,
                'category_name' => 'Courses & Curriculum',
                'category_slug' => 'courses',
                'question' => 'What courses are available at R-CAT?',
                'answer' => 'We offer courses in AWS Cloud Computing, Google Cloud Platform, Microsoft Azure, Ethical Hacking & Cybersecurity, Python Data Science, and Full Stack Web Development.'
            ],
            [
                'id' => 4,
                'category_id' => 4,
                'category_name' => 'Fees & Payment',
                'category_slug' => 'fees',
                'question' => 'What are the course fees?',
                'answer' => 'Course fees range from ₹75,000 to ₹95,000 depending on the program. We offer flexible payment options and scholarships for eligible candidates.'
            ],
            [
                'id' => 5,
                'category_id' => 5,
                'category_name' => 'Placement & Career',
                'category_slug' => 'placement',
                'question' => 'Do you provide placement assistance?',
                'answer' => 'Yes, we have dedicated placement assistance with 85-95% placement rates. We have partnerships with leading IT companies and provide interview preparation and resume building support.'
            ],
            [
                'id' => 6,
                'category_id' => 3,
                'category_name' => 'Courses & Curriculum',
                'category_slug' => 'courses',
                'question' => 'Are the courses industry-relevant?',
                'answer' => 'Yes, all courses are designed in collaboration with industry experts and major technology companies. The curriculum is regularly updated to match current industry requirements.'
            ],
            [
                'id' => 7,
                'category_id' => 4,
                'category_name' => 'Fees & Payment',
                'category_slug' => 'fees',
                'question' => 'Are there any scholarships available?',
                'answer' => 'Yes, scholarships are available for economically weaker sections, women candidates, and meritorious students. Up to 50% fee waiver is possible based on eligibility criteria.'
            ],
            [
                'id' => 8,
                'category_id' => 5,
                'category_name' => 'Placement & Career',
                'category_slug' => 'placement',
                'question' => 'What is the average salary after completing courses?',
                'answer' => 'The average starting salary ranges from ₹6 LPA to ₹15 LPA depending on the course and student performance. Cloud Computing and AI/ML graduates often get higher packages.'
            ]
        ];
        
        // Group FAQs by category
        $faqsByCategory = [];
        foreach ($allFaqs as $faq) {
            $faqsByCategory[$faq['category_slug']][] = $faq;
        }
        
        // JSON-LD Schema for FAQ
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => []
        ];
        
        foreach ($allFaqs as $faq) {
            $faqSchema['mainEntity'][] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }
        
        // Total FAQ count for display
        $totalFaqs = count($allFaqs);
        
        // Include the layout with content
        ob_start();
        include 'app/Views/pages/faq.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

// Initialize and run
$controller = new FAQController();
$controller->index();
?>
