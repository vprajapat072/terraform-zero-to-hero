<?php
/**
 * Router script for PHP development server
 * This ensures index.php is served for the root directory
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// If the request is for the root, serve index.php
if ($uri === '/' || $uri === '') {
    require_once __DIR__ . '/index.php';
    return true;
}

// Check if the file exists and serve it
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false; // Serve the requested resource as-is
}

// For all other requests, let index.php handle the routing
require_once __DIR__ . '/index.php';
return true;
?>
