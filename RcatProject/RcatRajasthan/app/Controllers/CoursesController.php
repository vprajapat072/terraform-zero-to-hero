<?php
/**
 * Courses Controller - R-CAT Rajasthan
 * Handles course listing and category pages
 */

// Include course database
require_once __DIR__ . '/../Data/CourseDatabase.php';

// SEO configuration for courses page
$pageTitle = "R-CAT Rajasthan Courses - IT Training Programs in Jaipur";
$pageDescription = "Explore comprehensive IT training courses at R-CAT Rajasthan including Cloud Computing, Cybersecurity, Data Science, and Software Development with industry certifications.";
$pageKeywords = "R-CAT Rajasthan courses, IT training Jaipur, cloud computing course, cybersecurity training, data science course, software development";
$canonical_url = "https://rcatrajasthan.com/courses";

// Open Graph tags for social sharing
$og_title = "Best IT Training Courses in Rajasthan - R-CAT";
$og_description = "Join India's leading IT training institute. Courses in AWS, Google Cloud, Cybersecurity, Data Science with 100% placement assistance.";
$og_image = "https://rcatrajasthan.com/assets/images/courses-banner.jpg";
$og_url = $canonical_url;

// Schema markup for course list
$courseSchema = [
    "@context" => "https://schema.org",
    "@type" => "EducationalOrganization",
    "name" => "R-CAT Rajasthan",
    "description" => "Leading IT training institute in Rajasthan offering industry-certified courses",
    "url" => "https://rcatrajasthan.com",
    "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => "Jaipur",
        "addressRegion" => "Rajasthan",
        "addressCountry" => "IN"
    ],
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "IT Training Courses",
        "itemListElement" => []
    ]
];

// Get all courses and categories
$allCourses = CourseDatabase::getAllCourses();
$categories = CourseDatabase::getCourseCategories();
$featuredCourses = CourseDatabase::getFeaturedCourses();
$courses = $allCourses; // For backward compatibility

// Add courses to schema
foreach ($allCourses as $course) {
    $courseSchema["hasOfferCatalog"]["itemListElement"][] = [
        "@type" => "Course",
        "name" => $course['title'],
        "description" => $course['short_description'],
        "provider" => [
            "@type" => "EducationalOrganization",
            "name" => "R-CAT Rajasthan"
        ],
        "hasCourseInstance" => [
            "@type" => "CourseInstance",
            "courseMode" => "in-person",
            "duration" => $course['duration'],
            "courseSchedule" => $course['batch_timing']
        ],
        "offers" => [
            "@type" => "Offer",
            "price" => str_replace('₹', '', str_replace(',', '', $course['fees'])),
            "priceCurrency" => "INR"
        ]
    ];
}

// Pass the schema array to the view (JSON encoding will happen in the view)
$courseSchemaData = $courseSchema;

// Include the layout with content
ob_start();
include 'app/Views/pages/courses.php';
$content = ob_get_clean();

include 'app/Views/layouts/main.php';
