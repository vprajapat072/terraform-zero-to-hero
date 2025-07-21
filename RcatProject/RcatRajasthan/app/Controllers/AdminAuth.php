<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminAuth extends Controller
{
    protected $db;
    protected $session;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }
    
    public function login()
    {
        // If already logged in, redirect to dashboard
        if ($this->session->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }
        
        $data = [
            'pageTitle' => 'Admin Login - R-CAT Rajasthan',
            'error' => ''
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            if ($this->validateLogin($username, $password)) {
                $this->session->set([
                    'admin_logged_in' => true,
                    'admin_username' => $username,
                    'login_time' => time()
                ]);
                
                return redirect()->to('/admin/dashboard');
            } else {
                $data['error'] = 'Invalid username or password';
            }
        }
        
        return view('admin/login', $data);
    }
    
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login')->with('message', 'Logged out successfully');
    }
    
    public function dashboard()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }
        
        // Get dashboard statistics
        $stats = $this->getDashboardStats();
        
        $data = [
            'pageTitle' => 'Admin Dashboard - R-CAT Rajasthan',
            'stats' => $stats
        ];
        
        return view('admin/dashboard', $data);
    }
    
    private function validateLogin($username, $password)
    {
        // For security, we'll use a simple admin credential system
        // In production, this should be properly hashed passwords in database
        $adminCredentials = [
            'admin' => 'RcatAdmin2024!',
            'rcat' => 'Rajasthan2024#'
        ];
        
        return isset($adminCredentials[$username]) && $adminCredentials[$username] === $password;
    }
    
    private function getDashboardStats()
    {
        $stats = [];
        
        // Blog posts statistics
        $stats['total_posts'] = $this->db->query('SELECT COUNT(*) as count FROM blog_posts')->getRow()->count;
        $stats['published_posts'] = $this->db->query('SELECT COUNT(*) as count FROM blog_posts WHERE status = "published"')->getRow()->count;
        $stats['draft_posts'] = $this->db->query('SELECT COUNT(*) as count FROM blog_posts WHERE status = "draft"')->getRow()->count;
        
        // Categories
        $stats['total_categories'] = $this->db->query('SELECT COUNT(*) as count FROM blog_categories')->getRow()->count;
        
        // Recent posts
        $stats['recent_posts'] = $this->db->query('SELECT id, title, status, created_at FROM blog_posts ORDER BY created_at DESC LIMIT 5')->getResultArray();
        
        return $stats;
    }
}
