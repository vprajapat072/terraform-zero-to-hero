<?php
/**
 * Course Detail Controller - R-CAT Rajasthan
 * Handles individual course detail pages
 */

// Include course database
require_once __DIR__ . '/../Data/CourseDatabase.php';

// Get course slug from URL
$courseSlug = isset($courseSlug) ? $courseSlug : '';

if (empty($courseSlug)) {
    header("HTTP/1.0 404 Not Found");
    include 'app/Views/errors/404.php';
    exit;
}

// Get course details
$course = CourseDatabase::getCourseBySlug($courseSlug);

if (!$course) {
    header("HTTP/1.0 404 Not Found");
    include 'app/Views/errors/404.php';
    exit;
}

// SEO configuration for course page
$page_title = $course['title'] . " - R-CAT Rajasthan Course Details";
$meta_description = $course['short_description'] . " Duration: " . $course['duration'] . ". Fees: " . $course['fees'] . ". Get industry certification with placement assistance.";
$meta_keywords = $course['title'] . ", " . $course['category'] . " course, R-CAT Rajasthan, " . str_replace(['-', '_'], ' ', $courseSlug);
$canonical_url = "https://rcatrajasthan.com/courses/" . $courseSlug;

// Open Graph tags for social sharing
$og_title = $course['title'] . " - Best IT Training in Rajasthan";
$og_description = $course['short_description'] . " ✓ Industry Certification ✓ Placement Support ✓ Hands-on Projects";
$og_image = isset($course['image']) ? "https://rcatrajasthan.com" . $course['image'] : "https://rcatrajasthan.com/assets/images/courses/default-course.jpg";
$og_url = $canonical_url;

// Course schema markup
$courseSchema = [
    "@context" => "https://schema.org",
    "@type" => "Course",
    "name" => $course['title'],
    "description" => $course['short_description'],
    "provider" => [
        "@type" => "EducationalOrganization",
        "name" => "R-CAT Rajasthan",
        "url" => "https://rcatrajasthan.com",
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => "Jaipur",
            "addressRegion" => "Rajasthan",
            "addressCountry" => "IN"
        ]
    ],
    "hasCourseInstance" => [
        "@type" => "CourseInstance",
        "courseMode" => "in-person",
        "duration" => $course['duration'],
        "courseSchedule" => $course['batch_timing'],
        "instructor" => [
            "@type" => "Person",
            "name" => "Industry Expert Instructors"
        ]
    ],
    "offers" => [
        "@type" => "Offer",
        "price" => str_replace('₹', '', str_replace(',', '', $course['fees'])),
        "priceCurrency" => "INR",
        "category" => $course['category'],
        "availability" => "https://schema.org/InStock"
    ],
    "coursePrerequisites" => $course['eligibility'],
    "educationalCredentialAwarded" => $course['certification'],
    "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => "4.8",
        "reviewCount" => "150",
        "bestRating" => "5",
        "worstRating" => "1"
    ]
];

// Add curriculum to schema if available
if (isset($course['curriculum']) && !empty($course['curriculum'])) {
    $courseSchema["syllabusSections"] = [];
    foreach ($course['curriculum'] as $moduleName => $topics) {
        $courseSchema["syllabusSections"][] = [
            "@type" => "Syllabus",
            "name" => $moduleName,
            "description" => implode(", ", $topics)
        ];
    }
}

$schema_markup = json_encode($courseSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

// Get related courses (same category)
$relatedCourses = CourseDatabase::getCoursesByCategory($course['category_slug']);
// Remove current course from related courses
$relatedCourses = array_filter($relatedCourses, function($relatedCourse) use ($courseSlug) {
    return $relatedCourse['slug'] !== $courseSlug;
});
// Limit to 3 related courses
$relatedCourses = array_slice($relatedCourses, 0, 3);

// Include the view
include 'app/Views/pages/course-detail.php';
?>
