<?php

/**
 * CodeIgniter Entry Point
 */

// Path to the system directory
$systemPath = '../vendor/codeigniter4/framework/system';

// Path to the application directory
$applicationPath = '../app';

// Path to the writable directory
$writablePath = '../writable';

// Check if paths exist
if (! realpath($systemPath)) {
    // Fallback for when CodeIgniter isn't installed via Composer
    $systemPath = '../system';
}

if (! realpath($applicationPath)) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Your application folder path does not appear to be set correctly.';
    exit(3);
}

// Set system constants
define('SYSTEMPATH', realpath($systemPath) . DIRECTORY_SEPARATOR);
define('APPPATH', realpath($applicationPath) . DIRECTORY_SEPARATOR);
define('WRITEPATH', realpath($writablePath) . DIRECTORY_SEPARATOR);
define('ROOTPATH', realpath(APPPATH . '../') . DIRECTORY_SEPARATOR);

// Environment
if (! defined('ENVIRONMENT')) {
    define('ENVIRONMENT', $_SERVER['CI_ENVIRONMENT'] ?? 'development');
}

// Load the framework bootstrap file
require_once SYSTEMPATH . 'bootstrap.php';

// Create the application instance
$app = \Config\Services::codeigniter();
$app->initialize();

// Boot the application
$context = is_cli() ? 'php-cli' : 'web';
$app->setContext($context);

// Run the application
$app->run();
