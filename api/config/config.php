<?php
// Database configuration (if needed)
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'config_builder');

// API settings
define('DEBUG_MODE', true);
define('LOG_PATH', '../logs/api.log');

// Error reporting
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Ensure required PHP extensions
if (!extension_loaded('yaml')) {
    die('YAML extension is required');
}

// Set timezone
date_default_timezone_set('UTC');

// Custom error handler
function errorHandler($errno, $errstr, $errfile, $errline) {
    $message = date('Y-m-d H:i:s') . " - Error: [$errno] $errstr - $errfile:$errline\n";
    error_log($message, 3, LOG_PATH);
    
    if (DEBUG_MODE) {
        echo json_encode([
            'status' => 500,
            'message' => 'Internal Server Error',
            'debug' => $message
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'message' => 'Internal Server Error'
        ]);
    }
    exit(1);
}

set_error_handler('errorHandler');