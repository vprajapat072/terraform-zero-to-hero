<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PerformanceController extends Controller
{
    /**
     * Enable browser caching headers
     */
    public function enableCaching()
    {
        // Set cache headers for static assets
        $this->response->setHeader('Cache-Control', 'public, max-age=31536000'); // 1 year
        $this->response->setHeader('Expires', gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
        $this->response->setHeader('ETag', md5($this->request->getUri()));
        
        return $this;
    }
    
    /**
     * Compress response for better performance
     */
    public function compressResponse($content)
    {
        if (extension_loaded('zlib') && !ob_get_contents()) {
            ob_start('ob_gzhandler');
        }
        
        return $content;
    }
    
    /**
     * Minify HTML output
     */
    public function minifyHTML($html)
    {
        // Remove extra whitespace
        $html = preg_replace('/\s+/', ' ', $html);
        
        // Remove comments
        $html = preg_replace('/<!--(.|\s)*?-->/', '', $html);
        
        // Remove unnecessary spaces around tags
        $html = preg_replace('/>\s+</', '><', $html);
        
        return trim($html);
    }
    
    /**
     * Generate critical CSS for above-the-fold content
     */
    public function generateCriticalCSS()
    {
        return "
        body{font-family:'Poppins',sans-serif;margin:0;padding:0;line-height:1.6;color:#333}
        .hero-section{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:80px 0}
        .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.1);padding:1rem 0}
        .btn-primary{background:#007bff;border:#007bff;padding:12px 30px;border-radius:8px}
        ";
    }
}

/**
 * Performance optimization filters
 */
class PerformanceFilters
{
    public function before($request, $arguments = null)
    {
        // Enable gzip compression
        if (extension_loaded('zlib') && !ob_get_level()) {
            ob_start('ob_gzhandler');
        }
        
        // Set security headers
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        return $request;
    }
    
    public function after($request, $response, $arguments = null)
    {
        // Add performance headers
        $response->setHeader('X-Powered-By', 'R-CAT Rajasthan');
        
        // Minify HTML for production
        if (ENVIRONMENT === 'production') {
            $body = $response->getBody();
            if (is_string($body)) {
                $minified = $this->minifyHTML($body);
                $response->setBody($minified);
            }
        }
        
        return $response;
    }
    
    private function minifyHTML($html)
    {
        // Remove extra whitespace
        $html = preg_replace('/\s+/', ' ', $html);
        
        // Remove comments (but preserve conditional comments)
        $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/', '', $html);
        
        // Remove unnecessary spaces around tags
        $html = preg_replace('/>\s+</', '><', $html);
        
        return trim($html);
    }
}
