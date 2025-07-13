<?php
require_once 'app/Config.php';

class AdminController {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            $this->showLogin();
            return;
        }
        
        // Show admin dashboard
        $this->showDashboard();
    }
    
    private function showLogin() {
        $pageTitle = "Admin Login - R-CAT Rajasthan";
        $pageDescription = "Administrator login panel for R-CAT Rajasthan website management.";
        $pageKeywords = "admin login, R-CAT admin, website management";
        
        // Handle login form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = Utils::sanitize($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            
            if ($this->authenticateUser($username, $password)) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_login_time'] = time();
                
                header('Location: /admin');
                exit;
            } else {
                $loginError = "Invalid username or password.";
            }
        }
        
        ob_start();
        include 'app/Views/admin/login.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/main.php';
    }
    
    private function showDashboard() {
        $pageTitle = "Admin Dashboard - R-CAT Rajasthan";
        $pageDescription = "Administrator dashboard for R-CAT Rajasthan website management.";
        $pageKeywords = "admin dashboard, R-CAT admin, website management";
        
        // Get dashboard statistics
        $stats = $this->getDashboardStats();
        
        ob_start();
        include 'app/Views/admin/dashboard.php';
        $content = ob_get_clean();
        
        include 'app/Views/layouts/admin.php';
    }
    
    private function authenticateUser($username, $password) {
        // For demonstration, using simple authentication
        // In production, use proper password hashing
        if ($username === 'admin' && $password === 'admin123') {
            return true;
        }
        
        // Check database for user only if database is connected
        if (isDbConnected() && $this->pdo) {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? AND is_active = 1");
                $stmt->execute([$username]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($password, $user['password'])) {
                    // Update last login
                    $updateStmt = $this->pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                    $updateStmt->execute([$user['id']]);
                    
                    $_SESSION['admin_user_id'] = $user['id'];
                    $_SESSION['admin_role'] = $user['role'];
                    
                    return true;
                }
            } catch (Exception $e) {
                error_log("Database authentication error: " . $e->getMessage());
            }
        }
        
        return false;
    }
    
    private function getDashboardStats() {
        $stats = [
            'total_courses' => 0,
            'total_blog_posts' => 0,
            'total_users' => 0,
            'total_subscribers' => 0,
            'recent_posts' => [],
            'recent_subscribers' => []
        ];
        
        if (isDbConnected() && $this->pdo) {
            try {
                // Get total courses
                $stmt = $this->pdo->query("SELECT COUNT(*) FROM courses WHERE is_active = 1");
                $stats['total_courses'] = $stmt->fetchColumn();
                
                // Get total blog posts
                $stmt = $this->pdo->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'published'");
                $stats['total_blog_posts'] = $stmt->fetchColumn();
                
                // Get total users
                $stmt = $this->pdo->query("SELECT COUNT(*) FROM users WHERE is_active = 1");
                $stats['total_users'] = $stmt->fetchColumn();
                
                // Get total subscribers
                $stmt = $this->pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE status = 'active'");
                $stats['total_subscribers'] = $stmt->fetchColumn();
                
                // Get recent blog posts
                $stmt = $this->pdo->query("SELECT title, created_at FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 5");
                $stats['recent_posts'] = $stmt->fetchAll();
                
                // Get recent subscribers
                $stmt = $this->pdo->query("SELECT email, subscribed_at FROM newsletter_subscribers WHERE status = 'active' ORDER BY subscribed_at DESC LIMIT 5");
                $stats['recent_subscribers'] = $stmt->fetchAll();
                
                return $stats;
                
            } catch (Exception $e) {
                error_log("Database query error: " . $e->getMessage());
            }
        }
        
        // Return mock data if database is not connected
        return [
            'total_courses' => 6,
            'total_blog_posts' => 12,
            'total_users' => 1,
            'total_subscribers' => 150,
            'recent_posts' => [
                ['title' => 'Top 5 Highest Paying Tech Skills in 2025', 'created_at' => '2025-07-10'],
                ['title' => 'Why Choose R-CAT for Your Career Growth', 'created_at' => '2025-07-08'],
                ['title' => 'Cloud Computing Trends to Watch in 2025', 'created_at' => '2025-07-05']
            ],
            'recent_subscribers' => [
                ['email' => 'john@example.com', 'subscribed_at' => '2025-07-10'],
                ['email' => 'jane@example.com', 'subscribed_at' => '2025-07-09'],
                ['email' => 'bob@example.com', 'subscribed_at' => '2025-07-08']
            ]
        ];
    }
}

$controller = new AdminController();
$controller->index();
?>
