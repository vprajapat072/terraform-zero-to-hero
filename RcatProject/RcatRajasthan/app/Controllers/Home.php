<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Database;

class Home extends Controller
{
    public function index()
    {
        // Try to get cached data first
        $cache = cache();
        $cacheKey = 'homepage_data';
        $cacheTime = 3600; // 1 hour
        
        $data = $cache->get($cacheKey);
        
        if (!$data) {
            $db = Database::connect();
            
            // Get featured courses from database
            $featuredCourses = $db->query('SELECT * FROM courses WHERE is_featured = 1 AND is_active = 1 ORDER BY created_at DESC LIMIT 6')->getResultArray();
            
            // Get blog posts for homepage
            try {
                $recentPosts = $db->query('SELECT title, slug, excerpt, created_at FROM blog_posts WHERE status = "published" ORDER BY created_at DESC LIMIT 3')->getResultArray();
            } catch (Exception $e) {
                $recentPosts = [];
            }
            
            $data = [
                'featured_courses' => $featuredCourses,
                'recent_posts' => $recentPosts
            ];
            
            // Cache the data
            $cache->save($cacheKey, $data, $cacheTime);
        }
        
        // SEO Data
        $pageTitle = "R-CAT Rajasthan - Transform Your Career with Advanced Technology Courses";
        $pageDescription = "Master cutting-edge technologies with R-CAT Rajasthan's comprehensive certification programs in Cloud Computing, AI/ML, Cybersecurity, and more. Expert training, industry partnerships, 95% placement rate.";
        $pageKeywords = "R-CAT Rajasthan, technology courses, cloud computing, AI machine learning, cybersecurity, data science, web development, digital marketing";
        
        // Load SEO helper for schema markup
        helper('SEO');
        $schema_markup = generate_organization_schema();
        
        return view('layouts/main', [
            'content' => view('pages/home', $data),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords,
            'schema_markup' => $schema_markup
        ]);
    }
}
