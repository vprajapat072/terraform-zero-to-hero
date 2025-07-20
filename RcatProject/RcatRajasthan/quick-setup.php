<?php
/**
 * Quick Database Setup for R-CAT Rajasthan
 * Run this once to create database tables
 */

require_once 'app/database.config.php';

echo "<!DOCTYPE html><html><head><title>Database Setup</title></head><body>";
echo "<h2>🗄️ R-CAT Rajasthan Database Setup</h2>";

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "<p>✅ Connected to database: " . DB_NAME . "</p>";
    
    // Create basic tables
    $tables = [
        "CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) UNIQUE NOT NULL,
            description TEXT,
            duration VARCHAR(100),
            fees DECIMAL(10,2),
            category VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "CREATE TABLE IF NOT EXISTS admin_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        
        "CREATE TABLE IF NOT EXISTS contact_inquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )"
    ];
    
    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }
    echo "<p>✅ Created database tables</p>";
    
    // Create default admin user
    $admin_check = $pdo->query("SELECT COUNT(*) FROM admin_users WHERE username = 'admin'")->fetchColumn();
    if ($admin_check == 0) {
        $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->exec("INSERT INTO admin_users (username, password_hash) VALUES ('admin', '$password_hash')");
        echo "<p>✅ Created admin user: admin / admin123</p>";
    } else {
        echo "<p>ℹ️ Admin user already exists</p>";
    }
    
    // Show status
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p><strong>Database has " . count($tables) . " tables</strong></p>";
    
    echo "<div style='background: #d4f6d4; padding: 15px; margin: 20px 0;'>";
    echo "<h3>🎉 Setup Complete!</h3>";
    echo "<p>Your database is ready. You can now:</p>";
    echo "<ul>";
    echo "<li>Visit <a href='/'>Homepage</a></li>";
    echo "<li>Login to <a href='/admin'>Admin Panel</a> (admin/admin123)</li>";
    echo "<li>Test all <a href='/courses'>Course Pages</a></li>";
    echo "</ul>";
    echo "<p><strong>Security:</strong> Delete this file after setup!</p>";
    echo "</div>";
    
} catch (PDOException $e) {
    echo "<div style='background: #f8d7da; padding: 15px; color: #721c24;'>";
    echo "<h3>❌ Setup Failed</h3>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "</div>";
}

echo "</body></html>";
?>
