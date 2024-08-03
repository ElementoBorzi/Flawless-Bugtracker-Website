<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include configuration file
include "config.php";

// System Variables
$installDir = "install/";

// Check if Composer autoload file exists
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die("Composer autoload file not found. Please run 'composer install'.");
}

// Include Composer autoload
require __DIR__ . '/vendor/autoload.php';

// Check if installation directory exists and .env file does not exist
if (file_exists($installDir) && !file_exists(__DIR__ . '/.env')) {
    header("Location: " . $installDir);
    exit;
}

// Call the application initialization method if the .env file is loaded successfully
Application::AppInit();
