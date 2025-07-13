<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SEOController extends Controller
{
    public function sitemap()
    {
        helper('SEO');
        
        $xml = generate_sitemap_xml();
        
        $this->response->setHeader('Content-Type', 'application/xml');
        return $xml;
    }
    
    public function robots()
    {
        helper('SEO');
        
        $content = generate_robots_txt();
        
        $this->response->setHeader('Content-Type', 'text/plain');
        return $content;
    }
}
