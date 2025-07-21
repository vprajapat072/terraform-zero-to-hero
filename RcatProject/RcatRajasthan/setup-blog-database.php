<?php
/**
 * Database Setup Script for Dynamic Blog Management
 * R-CAT Rajasthan Website
 */

// Database configuration
$host = 'localhost';
$username = 'u169982873_rcatrajasthan'; // Replace with your actual username
$password = 'Rcat@2024#DB'; // Replace with your actual password
$database = 'u169982873_rcatrajasthan'; // Replace with your actual database name

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Read and execute SQL schema
    $sqlFile = __DIR__ . '/blog_schema.sql';
    if (!file_exists($sqlFile)) {
        throw new Exception("SQL file not found: $sqlFile");
    }
    
    $sql = file_get_contents($sqlFile);
    
    // Split SQL into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    $successCount = 0;
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            try {
                $pdo->exec($statement);
                $successCount++;
                echo "✅ Executed statement successfully\n";
            } catch (PDOException $e) {
                // Continue execution even if some statements fail (e.g., table already exists)
                echo "⚠️  Statement warning: " . $e->getMessage() . "\n";
            }
        }
    }
    
    echo "\n🎉 Database setup completed!\n";
    echo "✅ Successfully executed $successCount SQL statements\n";
    
    // Verify tables were created
    $tables = ['blog_categories', 'blog_posts', 'blog_tags', 'post_tags'];
    echo "\n📊 Verifying table creation:\n";
    
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            $countStmt = $pdo->query("SELECT COUNT(*) FROM $table");
            $count = $countStmt->fetchColumn();
            echo "✅ Table '$table' exists with $count records\n";
        } else {
            echo "❌ Table '$table' not found\n";
        }
    }
    
    echo "\n🚀 Dynamic blog management database is ready!\n";
    echo "You can now use the dynamic BlogController to manage blog content.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
