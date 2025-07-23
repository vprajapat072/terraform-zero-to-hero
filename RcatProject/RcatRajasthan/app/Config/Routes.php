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
    $routes->get('/', 'AdminAuth::login');
    $routes->get('login', 'AdminAuth::login');
    $routes->post('login', 'AdminAuth::login');
    $routes->get('logout', 'AdminAuth::logout');
    $routes->get('dashboard', 'AdminAuth::dashboard');
    
    // Blog admin routes
    $routes->group('blog', function($routes) {
        $routes->get('/', 'BlogAdmin::index');
        $routes->get('posts', 'BlogAdmin::posts');
        $routes->get('create', 'BlogAdmin::create');
        $routes->post('create', 'BlogAdmin::create');
        $routes->get('edit/(:num)', 'BlogAdmin::edit/$1');
        $routes->post('edit/(:num)', 'BlogAdmin::edit/$1');
        $routes->post('delete/(:num)', 'BlogAdmin::delete/$1');
        $routes->get('categories', 'BlogAdmin::categories');
        $routes->post('categories/save', 'BlogAdmin::saveCategory');
        $routes->post('categories/update', 'BlogAdmin::updateCategory');
    });
});

// SEO Routes
$routes->get('sitemap.xml', 'SEO::sitemap');
$routes->get('robots.txt', 'SEO::robots');

// 404 page
$routes->set404Override('Errors::show_404');