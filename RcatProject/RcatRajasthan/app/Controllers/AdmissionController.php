<?php
require_once 'app/Config.php';

class AdmissionController {
    public function index() {
        $pageTitle = "Admission Process - R-CAT Rajasthan";
        $pageDescription = "Complete guide to R-CAT Rajasthan admission process, requirements, deadlines, and how to apply for technical courses.";
        $pageKeywords = "R-CAT admission, RCAT admission process, Rajasthan government course admission, how to apply RCAT";
        
        // Admission process steps
        $admissionSteps = [
            [
                'step' => 1,
                'title' => 'Choose Your Course',
                'description' => 'Browse our course catalog and select the program that matches your career goals.',
                'icon' => 'bi-search',
                'details' => [
                    'Visit our courses page',
                    'Compare different programs',
                    'Check eligibility criteria',
                    'Read course curriculum'
                ]
            ],
            [
                'step' => 2,
                'title' => 'Check Eligibility',
                'description' => 'Ensure you meet the minimum requirements for your chosen course.',
                'icon' => 'bi-check-circle',
                'details' => [
                    'Educational qualifications',
                    'Age requirements',
                    'Work experience (if applicable)',
                    'Language proficiency'
                ]
            ],
            [
                'step' => 3,
                'title' => 'Submit Application',
                'description' => 'Complete the online application form with all required documents.',
                'icon' => 'bi-file-earmark-text',
                'details' => [
                    'Fill online application form',
                    'Upload required documents',
                    'Pay application fee',
                    'Submit application'
                ]
            ],
            [
                'step' => 4,
                'title' => 'Selection Process',
                'description' => 'Participate in the selection process based on your chosen course.',
                'icon' => 'bi-person-check',
                'details' => [
                    'Merit-based selection',
                    'Interview (if required)',
                    'Entrance test (for specific courses)',
                    'Document verification'
                ]
            ],
            [
                'step' => 5,
                'title' => 'Confirmation',
                'description' => 'Receive admission confirmation and complete the enrollment process.',
                'icon' => 'bi-check-all',
                'details' => [
                    'Admission confirmation email',
                    'Fee payment',
                    'Course enrollment',
                    'Orientation program'
                ]
            ]
        ];
        
        // Important dates
        $importantDates = [
            [
                'event' => 'Application Start Date',
                'date' => '2025-02-01',
                'status' => 'upcoming'
            ],
            [
                'event' => 'Application Deadline',
                'date' => '2025-03-15',
                'status' => 'upcoming'
            ],
            [
                'event' => 'Selection Results',
                'date' => '2025-03-30',
                'status' => 'upcoming'
            ],
            [
                'event' => 'Course Commencement',
                'date' => '2025-04-15',
                'status' => 'upcoming'
            ]
        ];
        
        // Required documents
        $requiredDocuments = [
            'Educational Certificates (10th, 12th, Graduation)',
            'Identity Proof (Aadhaar Card, Passport, Voter ID)',
            'Address Proof (Utility Bill, Bank Statement)',
            'Recent Passport Size Photographs',
            'Category Certificate (if applicable)',
            'Income Certificate (for fee concession)',
            'Medical Certificate (if required)',
            'Work Experience Letter (for professional courses)'
        ];
        
        // Fee structure
        $feeStructure = [
            [
                'category' => 'General',
                'application_fee' => '₹500',
                'course_fee_range' => '₹15,000 - ₹35,000',
                'concession' => 'Merit-based scholarships available'
            ],
            [
                'category' => 'SC/ST',
                'application_fee' => '₹250',
                'course_fee_range' => '₹10,000 - ₹25,000',
                'concession' => 'Up to 50% fee concession'
            ],
            [
                'category' => 'OBC',
                'application_fee' => '₹350',
                'course_fee_range' => '₹12,000 - ₹30,000',
                'concession' => 'Up to 30% fee concession'
            ],
            [
                'category' => 'EWS',
                'application_fee' => '₹200',
                'course_fee_range' => '₹8,000 - ₹20,000',
                'concession' => 'Up to 60% fee concession'
            ]
        ];
        
        ob_start();
        include 'app/Views/pages/admission.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
}

$controller = new AdmissionController();
$controller->index();
?>
