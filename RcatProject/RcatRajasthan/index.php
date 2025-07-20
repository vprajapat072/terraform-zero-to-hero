<?php
/**
 * R-CAT Rajasthan Website
 * Fast, Responsive, and SEO-Optimized Information Portal
 */

// Load configuration files
require_once 'app/Config.php';

// Simple PHP routing for shared hosting
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Remove any query string
$path = strtok($path, '?');

// Define routes
switch ($path) {
    case '':
    case '/':
        include 'app/Controllers/HomeController.php';
        break;
    case '/about':
        include 'app/Controllers/AboutController.php';
        break;
    case '/courses':
        include 'app/Controllers/CoursesController.php';
        break;
    case '/admission':
        include 'app/Controllers/AdmissionController.php';
        break;
    case '/blog':
        include 'app/Controllers/BlogController.php';
        break;
    case '/faq':
        include 'app/Controllers/FAQController.php';
        break;
    case '/contact':
        include 'app/Controllers/Contact.php';
        break;
    case '/admin':
        include 'app/Controllers/AdminController.php';
        break;
    default:
        // Handle course detail pages
        if (preg_match('/^\/courses\/([a-z0-9-]+)$/', $path, $matches)) {
            $courseSlug = $matches[1];
            include 'app/Controllers/CourseDetailController.php';
        } else {
            // 404 Page
            http_response_code(404);
            include 'app/Views/errors/404.php';
        }
        break;
}
?>
