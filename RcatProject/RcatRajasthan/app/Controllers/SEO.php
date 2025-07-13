<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Database;

class SEO extends Controller
{
    /**
     * Generate dynamic sitemap.xml
     */
    public function sitemap()
    {
        $this->response->setContentType('application/xml');
        
        $db = Database::connect();
        $baseUrl = base_url();
        
        // Start sitemap
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        helper('SEO');
        
        // Static pages
        $staticPages = [
            ['url' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => $baseUrl . 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . 'courses', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . 'admission', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . 'blog', 'priority' => '0.7', 'changefreq' => 'daily']
        ];
        
        foreach ($staticPages as $page) {
            $sitemap .= generate_sitemap_url(
                clean_url_for_sitemap($page['url']),
                null,
                $page['changefreq'],
                $page['priority']
            );
        }
        
        // Dynamic course pages
        $courses = $db->query('SELECT slug, updated_at FROM courses WHERE is_active = 1')->getResultArray();
        foreach ($courses as $course) {
            $courseUrl = $baseUrl . 'courses/' . $course['slug'];
            $sitemap .= generate_sitemap_url(
                clean_url_for_sitemap($courseUrl),
                $course['updated_at'],
                'weekly',
                '0.8'
            );
        }
        
        // Dynamic blog pages
        try {
            $posts = $db->query('SELECT slug, updated_at FROM blog_posts WHERE status = "published"')->getResultArray();
            foreach ($posts as $post) {
                $postUrl = $baseUrl . 'blog/' . $post['slug'];
                $sitemap .= generate_sitemap_url(
                    clean_url_for_sitemap($postUrl),
                    $post['updated_at'],
                    'monthly',
                    '0.6'
                );
            }
        } catch (Exception $e) {
            // Blog table might not exist yet
        }
        
        $sitemap .= '</urlset>';
        
        return $this->response->setBody($sitemap);
    }
    
    /**
     * Generate robots.txt
     */
    public function robots()
    {
        $this->response->setContentType('text/plain');
        
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n\n";
        
        // Disallow admin and private areas
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /setup-database.php\n";
        $robots .= "Disallow: /test-database.php\n";
        $robots .= "Disallow: /app/\n";
        $robots .= "Disallow: /database/\n\n";
        
        // Sitemap location
        $robots .= "Sitemap: " . base_url('sitemap.xml') . "\n";
        
        return $this->response->setBody($robots);
    }
    
    /**
     * Generate performance report
     */
    public function performance()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin');
        }
        
        $db = Database::connect();
        
        // Gather performance metrics
        $metrics = [
            'total_courses' => $db->query('SELECT COUNT(*) as count FROM courses WHERE is_active = 1')->getRow()->count,
            'total_blog_posts' => 0,
            'database_size' => $this->getDatabaseSize($db),
            'cache_status' => $this->getCacheStatus(),
            'page_load_metrics' => $this->getPageLoadMetrics()
        ];
        
        try {
            $metrics['total_blog_posts'] = $db->query('SELECT COUNT(*) as count FROM blog_posts WHERE status = "published"')->getRow()->count;
        } catch (Exception $e) {
            // Blog table might not exist
        }
        
        return view('admin/performance', ['metrics' => $metrics]);
    }
    
    private function getDatabaseSize($db)
    {
        try {
            $result = $db->query("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS db_size FROM information_schema.tables WHERE table_schema = DATABASE()")->getRow();
            return $result ? $result->db_size . ' MB' : 'Unknown';
        } catch (Exception $e) {
            return 'N/A';
        }
    }
    
    private function getCacheStatus()
    {
        return cache()->isSupported() ? 'Enabled' : 'Disabled';
    }
    
    private function getPageLoadMetrics()
    {
        // Simplified metrics - in production you'd use real analytics
        return [
            'avg_load_time' => '1.2s',
            'mobile_score' => '94',
            'desktop_score' => '97',
            'core_web_vitals' => 'Good'
        ];
    }
}
