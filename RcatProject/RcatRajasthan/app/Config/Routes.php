<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'AboutController::index');
$routes->get('/courses', 'CoursesController::index');
$routes->get('/courses/(:segment)', 'CourseDetailController::index/$1');
$routes->get('/admission', 'AdmissionController::index');
$routes->post('/admission', 'AdmissionController::submit');
$routes->get('/blog', 'BlogNew::index');
$routes->get('/blog/(:segment)', 'BlogNew::post/$1');
$routes->get('/faq', 'FAQController::index');
$routes->get('/search', 'Search::index');
$routes->get('/search/suggestions', 'Search::suggestions');
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/submit', 'Contact::submit');
$routes->get('/contact/track', 'Contact::track');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'AdminController::login');
    $routes->get('login', 'AdminController::login');
    $routes->post('login', 'AdminController::authenticate');
    $routes->get('logout', 'AdminController::logout');
    $routes->get('dashboard', 'AdminController::dashboard');
});

// SEO Routes
$routes->get('sitemap.xml', 'SEO::sitemap');
$routes->get('robots.txt', 'SEO::robots');

// 404 page
$routes->set404Override('Errors::show_404');