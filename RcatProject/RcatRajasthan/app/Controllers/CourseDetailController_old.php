<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Database;
use CodeIgniter\Exceptions\PageNotFoundException;

class CourseDetailController extends Controller
{
    public function index($slug)
    {
        $db = Database::connect();
        
        $course = $db->query('SELECT * FROM courses WHERE slug = ? AND is_active = 1', [$slug])->getRowArray();
        
        if (!$course) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        // Decode JSON fields
        $course['curriculum'] = json_decode($course['curriculum'] ?? '[]', true);
        $course['features'] = json_decode($course['features'] ?? '[]', true);
        $course['eligibility'] = json_decode($course['eligibility'] ?? '[]', true);
        $course['career_opportunities'] = json_decode($course['career_opportunities'] ?? '[]', true);
        
        // SEO Data
        $pageTitle = $course['title'] . ' Course - R-CAT Rajasthan';
        $pageDescription = $course['description'];
        $pageKeywords = $course['keywords'];
        
        // Generate course schema markup
        helper('SEO');
        $schema_markup = generate_course_schema($course);
        
        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => base_url()],
            ['name' => 'Courses', 'url' => base_url('courses')],
            ['name' => $course['title'], 'url' => current_url()]
        ];
        
        return view('layouts/main', [
            'content' => view('pages/course-detail', ['course' => $course]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords,
            'schema_markup' => $schema_markup,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
