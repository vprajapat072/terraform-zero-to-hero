<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FAQController extends Controller
{
    public function index()
    {
        // Example FAQs - in production, fetch from DB
        $faqs = [
            [
                'question' => 'What is R-CAT Rajasthan?',
                'answer' => 'R-CAT Rajasthan is the Rajiv Gandhi Centre of Advanced Technology, a government initiative to provide advanced technology training in Rajasthan.'
            ],
            [
                'question' => 'How do I apply for a course?',
                'answer' => 'You can apply for any course through the online admission form available on the Admission page.'
            ],
            [
                'question' => 'Are the courses recognized?',
                'answer' => 'Yes, all R-CAT courses are recognized by the Government of Rajasthan and industry partners.'
            ],
            [
                'question' => 'Is there placement assistance?',
                'answer' => 'Yes, R-CAT provides placement support and career guidance for all students.'
            ]
        ];
        
        // SEO
        $pageTitle = 'Frequently Asked Questions - R-CAT Rajasthan';
        $pageDescription = 'Find answers to common questions about R-CAT Rajasthan, courses, admissions, and more.';
        $pageKeywords = 'R-CAT FAQ, Rajasthan technology courses, admissions, support';
        
        // Schema markup
        helper('SEO');
        $schema_markup = generate_faq_schema($faqs);
        
        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => base_url()],
            ['name' => 'FAQ', 'url' => current_url()]
        ];
        
        return view('layouts/main', [
            'content' => view('pages/faq', ['faqs' => $faqs]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords,
            'schema_markup' => $schema_markup,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
