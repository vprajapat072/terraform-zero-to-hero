<?php
/**
 * Database Configuration
 */

// Load database credentials from separate config file
$db_config_file = __DIR__ . '/database.config.php';
if (file_exists($db_config_file)) {
    require_once $db_config_file;
}

// Load production configuration
$production_config_file = __DIR__ . '/production.config.php';
if (file_exists($production_config_file)) {
    require_once $production_config_file;
}

class Database {
    // Hostinger Database Configuration (from database.config.php)
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $port;
    
    // Development/Demo Configuration (fallback)
    private $dev_host;
    private $dev_dbname;
    private $dev_username;
    private $dev_password;
    
    private $pdo;
    private $connected = false;
    
    public function __construct() {
        // Load configuration from constants or use defaults
        $this->host = defined('DB_HOST') ? DB_HOST : 'srv1261.hstgr.io';
        $this->dbname = defined('DB_NAME') ? DB_NAME : 'u473874865_rcat_rajasthan';
        $this->username = defined('DB_USER') ? DB_USER : 'rcat_user';
        $this->password = defined('DB_PASS') ? DB_PASS : 'Rcat@02012003';
        $this->port = defined('DB_PORT') ? DB_PORT : 3306;
        
        // Development configuration
        $this->dev_host = defined('DEV_DB_HOST') ? DEV_DB_HOST : 'localhost';
        $this->dev_dbname = defined('DEV_DB_NAME') ? DEV_DB_NAME : 'rcat_rajasthan';
        $this->dev_username = defined('DEV_DB_USER') ? DEV_DB_USER : 'root';
        $this->dev_password = defined('DEV_DB_PASS') ? DEV_DB_PASS : '';
        
        // Try to connect to Hostinger database first
        if ($this->connectToHostinger()) {
            return;
        }
        
        // Fallback to local development database
        if ($this->connectToLocal()) {
            return;
        }
        
        // No database connection available
        error_log("No database connection available. Running in demo mode.");
        $this->connected = false;
    }
    
    private function connectToHostinger() {
        try {
            // Check if MySQL PDO driver is available
            if (!extension_loaded('pdo_mysql')) {
                return false;
            }
            
            $charset = defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4';
            $timeout = defined('DB_TIMEOUT') ? DB_TIMEOUT : 10;
            
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};port={$this->port};charset={$charset}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_TIMEOUT => $timeout,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset}",
                ]
            );
            
            $this->connected = true;
            
            if (defined('DB_LOGGING') && DB_LOGGING) {
                error_log("Connected to Hostinger database successfully: {$this->dbname}");
            }
            
            return true;
            
        } catch (PDOException $e) {
            if (defined('DB_LOGGING') && DB_LOGGING) {
                error_log("Hostinger database connection failed: " . $e->getMessage());
            }
            
            // Try alternative IP-based connection if available
            if (defined('DB_HOST_IP') && DB_HOST_IP !== $this->host) {
                return $this->connectToHostingerIP();
            }
            
            return false;
        }
    }
    
    private function connectToHostingerIP() {
        try {
            $charset = defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4';
            $timeout = defined('DB_TIMEOUT') ? DB_TIMEOUT : 10;
            $ip_host = defined('DB_HOST_IP') ? DB_HOST_IP : '193.203.184.43';
            
            $this->pdo = new PDO(
                "mysql:host={$ip_host};dbname={$this->dbname};port={$this->port};charset={$charset}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_TIMEOUT => $timeout,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset}",
                ]
            );
            
            $this->connected = true;
            
            if (defined('DB_LOGGING') && DB_LOGGING) {
                error_log("Connected to Hostinger database via IP successfully: {$this->dbname}");
            }
            
            return true;
            
        } catch (PDOException $e) {
            if (defined('DB_LOGGING') && DB_LOGGING) {
                error_log("Hostinger database connection via IP failed: " . $e->getMessage());
            }
            return false;
        }
    }
    
    private function connectToLocal() {
        try {
            if (!extension_loaded('pdo_mysql')) {
                return false;
            }
            
            $this->pdo = new PDO(
                "mysql:host={$this->dev_host};dbname={$this->dev_dbname};charset=utf8mb4",
                $this->dev_username,
                $this->dev_password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
            
            $this->connected = true;
            error_log("Connected to local database successfully.");
            return true;
            
        } catch (PDOException $e) {
            error_log("Local database connection failed: " . $e->getMessage());
            return false;
        }
    }
    
    public function getConnection() {
        return $this->pdo;
    }
    
    public function isConnected() {
        return $this->connected;
    }
    
    public function getConnectionInfo() {
        if (!$this->connected) {
            return "Not connected";
        }
        
        try {
            $stmt = $this->pdo->query("SELECT DATABASE() as db_name");
            $result = $stmt->fetch();
            return "Connected to: " . $result['db_name'];
        } catch (Exception $e) {
            return "Connected (info unavailable)";
        }
    }
}

/**
 * Application Configuration
 */
class Config {
    const SITE_NAME = 'R-CAT Rajasthan';
    const SITE_DESCRIPTION = 'Fast & Easy Guide to R-CAT Rajasthan Courses';
    const SITE_URL = 'https://rcatrajasthan.com';
    const ADMIN_EMAIL = 'admin@rcatrajasthan.com';
    
    // SEO Configuration
    const DEFAULT_META_KEYWORDS = 'R-CAT Rajasthan, RCAT courses, Rajasthan government courses, skill development';
    const GOOGLE_ANALYTICS_ID = 'G-XXXXXXXXXX'; // Replace with actual GA4 ID
    
    // Security Configuration
    const SESSION_TIMEOUT = 3600; // 1 hour
    const MAX_LOGIN_ATTEMPTS = 5;
    
    // Cache Configuration
    const CACHE_ENABLED = true;
    const CACHE_DURATION = 3600; // 1 hour
}

/**
 * Utility Functions
 */
class Utils {
    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }
    
    public static function generateSlug($string) {
        $slug = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($string));
        return trim($slug, '-');
    }
    
    public static function formatDate($date) {
        return date('F j, Y', strtotime($date));
    }
    
    public static function truncate($text, $length = 150) {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '...';
    }
}

// Start session
session_start();

// Initialize database
$db = new Database();
$pdo = $db->getConnection();

// Global variable to check if database is connected
$GLOBALS['db_connected'] = $db->isConnected();

// Helper function to check database connection
function isDbConnected() {
    return $GLOBALS['db_connected'] ?? false;
}
?>
