<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Database;

class Search extends Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::connect();
    }
    
    public function index()
    {
        $query = $this->request->getGet('q');
        $type = $this->request->getGet('type') ?? 'all';
        $page = $this->request->getGet('page') ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $results = [];
        $totalResults = 0;
        
        if (!empty($query)) {
            $results = $this->performSearch($query, $type, $limit, $offset);
            $totalResults = $this->getSearchCount($query, $type);
        }
        
        // Pagination
        $totalPages = ceil($totalResults / $limit);
        
        // SEO Data
        $pageTitle = !empty($query) ? "Search Results for '{$query}' - R-CAT Rajasthan" : "Search - R-CAT Rajasthan";
        $pageDescription = "Search R-CAT Rajasthan for courses, blog articles, and information about technology training programs.";
        $pageKeywords = "search, R-CAT courses, technology training, blog search";
        
        return view('layouts/main', [
            'content' => view('pages/search', [
                'query' => $query,
                'type' => $type,
                'results' => $results,
                'total_results' => $totalResults,
                'current_page' => $page,
                'total_pages' => $totalPages
            ]),
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageKeywords' => $pageKeywords
        ]);
    }
    
    public function suggestions()
    {
        $query = $this->request->getGet('q');
        
        if (strlen($query) < 2) {
            return $this->response->setJSON([]);
        }
        
        $suggestions = [];
        
        // Course suggestions
        $courseResults = $this->db->query(
            'SELECT title, slug FROM courses WHERE (title LIKE ? OR description LIKE ?) AND is_active = 1 LIMIT 5',
            ['%' . $query . '%', '%' . $query . '%']
        )->getResultArray();
        
        foreach ($courseResults as $course) {
            $suggestions[] = [
                'title' => $course['title'],
                'type' => 'course',
                'url' => base_url('courses/' . $course['slug'])
            ];
        }
        
        // Blog suggestions
        try {
            $blogResults = $this->db->query(
                'SELECT title, slug FROM blog_posts WHERE (title LIKE ? OR content LIKE ?) AND status = "published" LIMIT 5',
                ['%' . $query . '%', '%' . $query . '%']
            )->getResultArray();
            
            foreach ($blogResults as $post) {
                $suggestions[] = [
                    'title' => $post['title'],
                    'type' => 'blog',
                    'url' => base_url('blog/' . $post['slug'])
                ];
            }
        } catch (Exception $e) {
            // Blog table might not exist
        }
        
        return $this->response->setJSON($suggestions);
    }
    
    private function performSearch($query, $type, $limit, $offset)
    {
        $results = [];
        $searchTerm = '%' . $query . '%';
        
        if ($type === 'all' || $type === 'courses') {
            // Search courses
            $courseResults = $this->db->query(
                'SELECT title, slug, description, duration, fee, level, "course" as type 
                 FROM courses 
                 WHERE (title LIKE ? OR description LIKE ? OR keywords LIKE ?) AND is_active = 1
                 ORDER BY 
                   CASE 
                     WHEN title LIKE ? THEN 1
                     WHEN description LIKE ? THEN 2
                     ELSE 3
                   END
                 LIMIT ? OFFSET ?',
                [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $limit, $offset]
            )->getResultArray();
            
            foreach ($courseResults as $course) {
                $course['url'] = base_url('courses/' . $course['slug']);
                $course['excerpt'] = $this->generateExcerpt($course['description'], $query);
                $results[] = $course;
            }
        }
        
        if ($type === 'all' || $type === 'blog') {
            // Search blog posts
            try {
                $blogResults = $this->db->query(
                    'SELECT title, slug, excerpt, content, author, created_at, "blog" as type
                     FROM blog_posts 
                     WHERE (title LIKE ? OR content LIKE ? OR excerpt LIKE ? OR tags LIKE ?) AND status = "published"
                     ORDER BY 
                       CASE 
                         WHEN title LIKE ? THEN 1
                         WHEN excerpt LIKE ? THEN 2
                         ELSE 3
                       END
                     LIMIT ? OFFSET ?',
                    [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $limit, $offset]
                )->getResultArray();
                
                foreach ($blogResults as $post) {
                    $post['url'] = base_url('blog/' . $post['slug']);
                    $post['excerpt'] = $this->generateExcerpt($post['content'], $query);
                    $results[] = $post;
                }
            } catch (Exception $e) {
                // Blog table might not exist
            }
        }
        
        return $results;
    }
    
    private function getSearchCount($query, $type)
    {
        $searchTerm = '%' . $query . '%';
        $count = 0;
        
        if ($type === 'all' || $type === 'courses') {
            $courseCount = $this->db->query(
                'SELECT COUNT(*) as count FROM courses 
                 WHERE (title LIKE ? OR description LIKE ? OR keywords LIKE ?) AND is_active = 1',
                [$searchTerm, $searchTerm, $searchTerm]
            )->getRow()->count;
            
            $count += $courseCount;
        }
        
        if ($type === 'all' || $type === 'blog') {
            try {
                $blogCount = $this->db->query(
                    'SELECT COUNT(*) as count FROM blog_posts 
                     WHERE (title LIKE ? OR content LIKE ? OR excerpt LIKE ? OR tags LIKE ?) AND status = "published"',
                    [$searchTerm, $searchTerm, $searchTerm, $searchTerm]
                )->getRow()->count;
                
                $count += $blogCount;
            } catch (Exception $e) {
                // Blog table might not exist
            }
        }
        
        return $count;
    }
    
    private function generateExcerpt($content, $query, $length = 200)
    {
        // Remove HTML tags
        $text = strip_tags($content);
        
        // Find the position of the search query
        $pos = stripos($text, $query);
        
        if ($pos !== false) {
            // Extract text around the search term
            $start = max(0, $pos - 100);
            $excerpt = substr($text, $start, $length);
            
            // Highlight the search term
            $excerpt = preg_replace('/(' . preg_quote($query, '/') . ')/i', '<mark>$1</mark>', $excerpt);
        } else {
            // Just take the first part of the content
            $excerpt = substr($text, 0, $length);
        }
        
        return $excerpt . '...';
    }
}
