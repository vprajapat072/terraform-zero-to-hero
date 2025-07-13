<?php
/**
 * Database Connection Test Script
 * Use this script to test your Hostinger database connection
 */

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>🗄️ Database Connection Test</h2>";

// Test 1: Check if PDO MySQL extension is available
echo "<h3>1. Checking PDO MySQL Extension</h3>";
if (extension_loaded('pdo_mysql')) {
    echo "✅ PDO MySQL extension is loaded<br>";
} else {
    echo "❌ PDO MySQL extension is NOT loaded<br>";
    echo "This is required for database connectivity.<br>";
}

// Test 2: Test Hostinger Database Connection
echo "<h3>2. Testing Hostinger Database Connection</h3>";

// Load database configuration
$db_config_file = __DIR__ . '/app/database.config.php';
if (file_exists($db_config_file)) {
    require_once $db_config_file;
    echo "✅ Database configuration file loaded<br>";
} else {
    echo "❌ Database configuration file not found: $db_config_file<br>";
    echo "Please copy database.config.template.php to database.config.php and update with your credentials<br>";
}

// Use configuration from constants or defaults
$host = defined('DB_HOST') ? DB_HOST : 'srv1261.hstgr.io';
$dbname = defined('DB_NAME') ? DB_NAME : 'u473874865_rcat_rajasthan';
$username = defined('DB_USER') ? DB_USER : 'rcat_user';
$password = defined('DB_PASS') ? DB_PASS : 'Rcat@02012003';
$port = defined('DB_PORT') ? DB_PORT : 3306;

echo "<strong>Connection Details:</strong><br>";
echo "Host: $host<br>";
echo "Database: $dbname<br>";
echo "Username: $username<br>";
echo "Port: $port<br><br>";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => 10,
        ]
    );
    
    echo "✅ <strong>DATABASE CONNECTION SUCCESSFUL!</strong><br>";
    
    // Test 3: Get database info
    echo "<h3>3. Database Information</h3>";
    $stmt = $pdo->query("SELECT DATABASE() as current_db, VERSION() as mysql_version");
    $info = $stmt->fetch();
    
    echo "Current Database: " . $info['current_db'] . "<br>";
    echo "MySQL Version: " . $info['mysql_version'] . "<br>";
    
    // Test 4: Check if tables exist
    echo "<h3>4. Checking Database Tables</h3>";
    $tables = ['users', 'courses', 'blog_posts', 'newsletter_subscribers', 'admissions', 'site_settings'];
    
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
            $count = $stmt->fetchColumn();
            echo "✅ Table '$table' exists with $count records<br>";
        } catch (PDOException $e) {
            echo "❌ Table '$table' does not exist<br>";
        }
    }
    
    // Test 5: Test a simple query
    echo "<h3>5. Testing Sample Query</h3>";
    try {
        $stmt = $pdo->query("SELECT 'Hello from Hostinger Database!' as message");
        $result = $stmt->fetch();
        echo "✅ Query successful: " . $result['message'] . "<br>";
    } catch (PDOException $e) {
        echo "❌ Query failed: " . $e->getMessage() . "<br>";
    }
    
    echo "<br><h3>🎉 All Tests Passed!</h3>";
    echo "Your database connection is working perfectly. You can now use the website with real data.<br>";
    
} catch (PDOException $e) {
    echo "❌ <strong>DATABASE CONNECTION FAILED!</strong><br>";
    echo "<strong>Error:</strong> " . $e->getMessage() . "<br><br>";
    
    echo "<h3>📋 Troubleshooting Steps:</h3>";
    echo "<ol>";
    echo "<li><strong>Check your credentials:</strong> Verify host, database name, username, and password</li>";
    echo "<li><strong>Enable Remote MySQL:</strong> Make sure Remote MySQL is enabled in Hostinger</li>";
    echo "<li><strong>Check IP whitelist:</strong> Add your current IP to the Remote MySQL whitelist</li>";
    echo "<li><strong>Verify database exists:</strong> Make sure the database is created in Hostinger</li>";
    echo "<li><strong>Check firewall:</strong> Ensure port 3306 is not blocked</li>";
    echo "</ol>";
}

// Test 6: Show current IP address
echo "<h3>6. Current IP Address</h3>";
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
echo "Your current IP address: <strong>$ip</strong><br>";
echo "Make sure this IP is whitelisted in your Hostinger Remote MySQL settings.<br>";

?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f5f5f5;
}
h2 {
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}
h3 {
    color: #555;
    margin-top: 20px;
}
</style>
