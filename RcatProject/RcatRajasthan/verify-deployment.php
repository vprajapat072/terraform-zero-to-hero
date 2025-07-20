<?php
/**
 * Production Deployment Verification Script
 * URL: https://rcatrajasthan.com/verify-deployment.php
 * 
 * This script checks if the production deployment is working correctly
 * Remove this file after successful verification for security
 */

// Security check - only allow access during deployment verification
$allowed_ips = ['your_ip_here']; // Add your IP address
$client_ip = $_SERVER['REMOTE_ADDR'] ?? '';

// Uncomment the following lines for IP restriction
// if (!in_array($client_ip, $allowed_ips) && !in_array('127.0.0.1', $allowed_ips)) {
//     http_response_code(403);
//     die('Access denied');
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-CAT Rajasthan - Deployment Verification</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .status { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .warning { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
        .info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🚀 R-CAT Rajasthan - Production Deployment Verification</h1>
    <p><strong>Domain:</strong> <?= $_SERVER['HTTP_HOST'] ?></p>
    <p><strong>Verification Time:</strong> <?= date('Y-m-d H:i:s T') ?></p>

    <div class="section">
        <h2>1. Server Environment Check</h2>
        
        <?php
        // PHP Version Check
        $php_version = PHP_VERSION;
        $min_php_version = '7.4.0';
        
        if (version_compare($php_version, $min_php_version, '>=')) {
            echo "<div class='status success'>✅ PHP Version: $php_version (Minimum: $min_php_version)</div>";
        } else {
            echo "<div class='status error'>❌ PHP Version: $php_version (Minimum required: $min_php_version)</div>";
        }
        
        // Check required PHP extensions
        $required_extensions = ['pdo', 'pdo_mysql', 'json', 'mbstring', 'curl'];
        foreach ($required_extensions as $ext) {
            if (extension_loaded($ext)) {
                echo "<div class='status success'>✅ PHP Extension: $ext</div>";
            } else {
                echo "<div class='status error'>❌ Missing PHP Extension: $ext</div>";
            }
        }
        
        // Check file permissions
        $writable_dirs = ['assets/uploads', 'logs'];
        foreach ($writable_dirs as $dir) {
            if (is_writable($dir)) {
                echo "<div class='status success'>✅ Directory writable: $dir</div>";
            } else {
                echo "<div class='status warning'>⚠️ Directory not writable: $dir (may need chmod 755 or 777)</div>";
            }
        }
        ?>
    </div>

    <div class="section">
        <h2>2. Configuration Check</h2>
        
        <?php
        // Check if config files exist
        $config_files = [
            'app/database.config.php' => 'Database configuration',
            'app/production.config.php' => 'Production configuration',
            '.htaccess' => 'URL rewriting configuration',
            'robots.txt' => 'Search engine instructions',
            'sitemap.xml' => 'Site structure for search engines'
        ];
        
        foreach ($config_files as $file => $description) {
            if (file_exists($file)) {
                echo "<div class='status success'>✅ $description: $file</div>";
            } else {
                echo "<div class='status error'>❌ Missing: $file ($description)</div>";
            }
        }
        
        // Check if production config is loaded
        if (defined('SITE_URL')) {
            echo "<div class='status success'>✅ Production configuration loaded</div>";
            echo "<div class='status info'>🌐 Site URL: " . SITE_URL . "</div>";
        } else {
            echo "<div class='status error'>❌ Production configuration not loaded</div>";
        }
        ?>
    </div>

    <div class="section">
        <h2>3. Database Connection Test</h2>
        
        <?php
        try {
            require_once 'app/database.config.php';
            
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_TIMEOUT => 10
                ]
            );
            
            echo "<div class='status success'>✅ Database connection successful</div>";
            echo "<div class='status info'>🗄️ Database: " . DB_NAME . " on " . DB_HOST . "</div>";
            
            // Test a simple query
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '" . DB_NAME . "'");
            $result = $stmt->fetch();
            echo "<div class='status info'>📊 Database tables found: " . $result['count'] . "</div>";
            
        } catch (PDOException $e) {
            echo "<div class='status error'>❌ Database connection failed: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>

    <div class="section">
        <h2>4. URL Routing Test</h2>
        
        <?php
        $test_urls = [
            '/' => 'Homepage',
            '/about' => 'About page',
            '/courses' => 'Courses listing',
            '/courses/aws-solutions-architect' => 'Course detail page',
            '/admission' => 'Admission page',
            '/blog' => 'Blog page',
            '/faq' => 'FAQ page',
            '/contact' => 'Contact page'
        ];
        
        echo "<div class='status info'>🔗 Test these URLs manually:</div>";
        foreach ($test_urls as $url => $description) {
            $full_url = 'https://' . $_SERVER['HTTP_HOST'] . $url;
            echo "<div class='status info'>📄 <a href='$full_url' target='_blank'>$full_url</a> ($description)</div>";
        }
        ?>
    </div>

    <div class="section">
        <h2>5. Security Headers Test</h2>
        
        <?php
        $security_headers = [
            'X-Frame-Options',
            'X-Content-Type-Options',
            'X-XSS-Protection',
            'Referrer-Policy'
        ];
        
        echo "<div class='status info'>🔒 Security headers (check with browser dev tools):</div>";
        foreach ($security_headers as $header) {
            echo "<div class='status info'>🛡️ Expected header: $header</div>";
        }
        
        // Check HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            echo "<div class='status success'>✅ HTTPS enabled</div>";
        } else {
            echo "<div class='status warning'>⚠️ HTTPS not detected (may be behind proxy)</div>";
        }
        ?>
    </div>

    <div class="section">
        <h2>6. Performance Test</h2>
        
        <?php
        $start_time = microtime(true);
        
        // Simulate some operations
        for ($i = 0; $i < 1000; $i++) {
            $dummy = md5($i);
        }
        
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time) * 1000;
        
        if ($execution_time < 100) {
            echo "<div class='status success'>✅ Server performance: {$execution_time}ms (Excellent)</div>";
        } elseif ($execution_time < 500) {
            echo "<div class='status info'>ℹ️ Server performance: {$execution_time}ms (Good)</div>";
        } else {
            echo "<div class='status warning'>⚠️ Server performance: {$execution_time}ms (May need optimization)</div>";
        }
        
        // Memory usage
        $memory_usage = memory_get_usage(true) / 1024 / 1024;
        echo "<div class='status info'>💾 Memory usage: " . round($memory_usage, 2) . " MB</div>";
        ?>
    </div>

    <div class="section">
        <h2>7. Next Steps</h2>
        
        <div class="status info">
            <h3>Immediate Actions:</h3>
            <ul>
                <li>✅ Verify all test URLs are working correctly</li>
                <li>🔍 Test course enrollment and contact forms</li>
                <li>📱 Test mobile responsiveness</li>
                <li>🚀 Submit sitemap to Google Search Console</li>
                <li>📊 Set up Google Analytics 4</li>
                <li>🗑️ <strong>Delete this verification file for security</strong></li>
            </ul>
        </div>
        
        <div class="status warning">
            <h3>Security Note:</h3>
            <p><strong>Important:</strong> Delete this file (verify-deployment.php) after successful verification to prevent unauthorized access to server information.</p>
        </div>
    </div>

    <div class="section">
        <h2>8. Contact Information</h2>
        <div class="status info">
            <p><strong>Website:</strong> https://rcatrajasthan.com</p>
            <p><strong>Admin Email:</strong> admin@rcatrajasthan.com</p>
            <p><strong>Deployment Date:</strong> <?= date('Y-m-d H:i:s T') ?></p>
        </div>
    </div>

    <style>
        .section { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</body>
</html>
