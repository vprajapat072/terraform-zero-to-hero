<?php
/**
 * Database Credentials Configuration Template
 * 
 * Instructions:
 * 1. Copy this file to 'database.config.php'
 * 2. Update the values with your actual database credentials
 * 3. The 'database.config.php' file is ignored by Git for security
 */

// Hostinger Database Configuration
define('DB_HOST', 'your-hostinger-mysql-host');
define('DB_NAME', 'your-database-name');
define('DB_USER', 'your-database-username');
define('DB_PASS', 'your-database-password');
define('DB_PORT', 3306);

// Alternative IP-based connection (if needed)
define('DB_HOST_IP', 'your-hostinger-ip-address');

// Development/Local Database Configuration (fallback)
define('DEV_DB_HOST', 'localhost');
define('DEV_DB_NAME', 'rcat_rajasthan');
define('DEV_DB_USER', 'root');
define('DEV_DB_PASS', '');

// Database connection timeout (seconds)
define('DB_TIMEOUT', 10);

// Enable/disable database connection logging
define('DB_LOGGING', true);

// Database charset
define('DB_CHARSET', 'utf8mb4');

// Database collation
define('DB_COLLATION', 'utf8mb4_unicode_ci');

// Connection retry attempts
define('DB_RETRY_ATTEMPTS', 3);

// Connection retry delay (seconds)
define('DB_RETRY_DELAY', 2);

/**
 * Example Configuration for Hostinger:
 * 
 * define('DB_HOST', 'srv1261.hstgr.io');
 * define('DB_NAME', 'u473874865_rcat_rajasthan');
 * define('DB_USER', 'rcat_user');
 * define('DB_PASS', 'your-secure-password');
 * define('DB_HOST_IP', '193.203.184.43');
 */
?>
