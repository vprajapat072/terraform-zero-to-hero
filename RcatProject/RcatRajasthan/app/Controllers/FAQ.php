<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FAQ extends Controller
{
    public function index()
    {
        // FAQ data - in production this would come from database
        $faqs = [
            [
                'category' => 'General',
                'questions' => [
                    [
                        'question' => 'What is R-CAT Rajasthan?',
                        'answer' => 'R-CAT (Rajiv Gandhi Centre of Advanced Technology) Rajasthan is a premier technology training institute offering comprehensive certification programs in cutting-edge technologies like Cloud Computing, AI/ML, Cybersecurity, Data Science, and Digital Marketing.'
                    ],
                    [
                        'question' => 'How long are the courses?',
                        'answer' => 'Course durations vary based on the program. Typically, our courses range from 4 months (Digital Marketing) to 8 months (AI & Machine Learning). Each course is designed to provide comprehensive training with hands-on projects.'
                    ],
                    [
                        'question' => 'Do you provide placement assistance?',
                        'answer' => 'Yes, we provide comprehensive placement assistance including resume building, interview preparation, industry connections, and direct referrals to our partner companies. We maintain a 95% placement rate across all programs.'
                    ]
                ]
            ],
            [
                'category' => 'Admission',
                'questions' => [
                    [
                        'question' => 'What are the eligibility criteria?',
                        'answer' => 'Eligibility varies by course. Generally, we require graduation in any discipline for most programs. Some advanced courses may require specific technical background. Check individual course pages for detailed eligibility criteria.'
                    ],
                    [
                        'question' => 'How can I apply for admission?',
                        'answer' => 'You can apply online through our admission page, visit our campus, or call our admission helpline. The process includes filling an application form, document verification, and a counseling session to choose the right program.'
                    ],
                    [
                        'question' => 'Is there an entrance exam?',
                        'answer' => 'Most of our courses do not require an entrance exam. However, for advanced programs like AI/ML, we may conduct a basic aptitude test to ensure you have the necessary foundation for the course.'
                    ]
                ]
            ],
            [
                'category' => 'Courses',
                'questions' => [
                    [
                        'question' => 'Are the courses industry-relevant?',
                        'answer' => 'Absolutely! Our curriculum is designed in collaboration with industry experts and updated regularly to match current market demands. We focus on practical, hands-on learning with real-world projects.'
                    ],
                    [
                        'question' => 'Do you provide certificates?',
                        'answer' => 'Yes, upon successful completion of any course, you receive an R-CAT certification. Many of our courses also prepare you for industry-standard certifications from partners like AWS, Google, Microsoft, and others.'
                    ],
                    [
                        'question' => 'Can I attend classes online?',
                        'answer' => 'We offer both classroom and online learning options. Our hybrid model allows you to choose the format that best suits your schedule and learning preferences.'
                    ]
                ]
            ],
            [
                'category' => 'Fees & Payment',
                'questions' => [
                    [
                        'question' => 'What is the fee structure?',
                        'answer' => 'Course fees range from ₹25,000 to ₹45,000 depending on the program. We offer flexible payment options including installments, scholarships for deserving candidates, and early bird discounts.'
                    ],
                    [
                        'question' => 'Do you offer EMI options?',
                        'answer' => 'Yes, we provide EMI options in partnership with leading financial institutions. You can opt for 3, 6, or 12-month installment plans with minimal processing fees.'
                    ],
                    [
                        'question' => 'Are there any hidden charges?',
                        'answer' => 'No, we believe in complete transparency. The course fee includes all study materials, lab access, project guidance, and placement assistance. There are no hidden charges.'
                    ]
                ]
            ]
        ];
        
        // SEO Data
        $pageTitle = 'Frequently Asked Questions - R-CAT Rajasthan';
        $pageDescription = 'Find answers to common questions about R-CAT Rajasthan courses, admission process, fees, placement assistance, and more. Get all the information you need.';
        $pageKeywords = 'R-CAT FAQ, frequently asked questions, admission, courses, fees, placement, eligibility';
        
        // Generate FAQ schema markup
        helper('SEO');
        $schema_markup = $this->generateFAQSchema($faqs);
        
        return view('layouts/main', [
            'content' => view('pages/faq', ['faqs' => $faqs]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords,
            'schema_markup' => $schema_markup
        ]);
    }
    
    private function generateFAQSchema($faqs)
    {
        $faqList = [];
        
        foreach ($faqs as $category) {
            foreach ($category['questions'] as $qa) {
                $faqList[] = [
                    "@type" => "Question",
                    "name" => $qa['question'],
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => $qa['answer']
                    ]
                ];
            }
        }
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $faqList
        ];
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT) . '</script>';
    }
}
