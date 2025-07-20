<?php
/**
 * Database Connection Test Script
 * Use this to test if the database credentials are working
 */

echo "<h2>🧪 Database Connection Test</h2>";

// Load the database configuration
require_once 'app/database.config.php';

echo "<p><strong>Testing connection with:</strong></p>";
echo "<ul>";
echo "<li>Host: " . DB_HOST . "</li>";
echo "<li>Database: " . DB_NAME . "</li>";
echo "<li>Username: " . DB_USER . "</li>";
echo "<li>Password: " . (DB_PASS ? str_repeat('*', strlen(DB_PASS)) : 'Not set') . "</li>";
echo "</ul>";

try {
    echo "<p>🔄 Attempting connection...</p>";
    
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
    
    echo "<div style='color: green; padding: 10px; background: #d4f9d4; border: 1px solid green; margin: 10px 0;'>";
    echo "✅ <strong>Database connection successful!</strong>";
    echo "</div>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT VERSION() as version");
    $result = $stmt->fetch();
    echo "<p><strong>MySQL Version:</strong> " . $result['version'] . "</p>";
    
    // Check if tables exist
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<p><strong>Tables in database (" . count($tables) . "):</strong></p>";
    if (count($tables) > 0) {
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>" . htmlspecialchars($table) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p><em>No tables found. You may need to import your database schema.</em></p>";
    }
    
} catch (PDOException $e) {
    echo "<div style='color: red; padding: 10px; background: #f9d4d4; border: 1px solid red; margin: 10px 0;'>";
    echo "❌ <strong>Database connection failed!</strong><br>";
    echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage());
    echo "</div>";
    
    echo "<h3>🔧 Troubleshooting Tips:</h3>";
    echo "<ul>";
    echo "<li>Check if the database username includes the prefix (e.g., u473874865_rcat_user)</li>";
    echo "<li>Verify the password is correct</li>";
    echo "<li>Ensure the database exists in your Hostinger control panel</li>";
    echo "<li>Check if the server hostname is correct</li>";
    echo "<li>Verify your IP is allowed to connect (if IP restrictions are enabled)</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><small>🗑️ <strong>Remember to delete this file after testing for security!</strong></small></p>";
?>
