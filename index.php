<?php
include "config.php";

//System Variables
$installDir = "install/";

require __DIR__ . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/')->load();

echo getenv('APP_ENV');
echo $_ENV['APP_NAME'];

//Page Action
if (file_exists($installDir)) {
	header("Location: ".$installDir);
} else {
	Application::AppInit();
}
?>