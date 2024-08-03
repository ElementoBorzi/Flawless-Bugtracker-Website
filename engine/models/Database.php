<?php

use Dotenv\Repository\Adapter\EnvConstAdapter;

/**
 * This class is used for Database related functions
 *
 * @name	: Database.php
 * @package	: Flawless
 * @author	: Gabriel Ferreira <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
 */
class Database extends Application {
    // Construct class
    public function __construct() {
        // Load .env file if it exists
        if (file_exists(__DIR__ . '/.env')) {
            try {
                // Initialize Dotenv and load .env file
                Dotenv\Dotenv::createUnsafeImmutable(__DIR__)->load();
            } catch (Exception $e) {
                // Handle errors related to loading .env file
                die("Error loading .env file: " . $e->getMessage());
            }
        } else {
            // If the .env file does not exist, prompt to run the installation process
            die("Error: .env file does not exist. Please run the installation process.");
        }
    }
        
    protected $host = $_ENV["host"];
    protected $username = $_ENV["username"];
    protected $password = $_ENV["password"];
    protected $database = $_ENV["database"];

    /**
	 * Connect's the system to the database
	 * 
     * @param	: $host (string)
     * @param	: $username (string)
     * @param	: $password (string)
     * @param	: $database (string)
	 * @return	: $connect (string)
	*/
    protected static function connect() {
        try {
            $connect = new PDO("mysql:host=".self::$host.";dbname=".self::$database."", self::$username, self::$password);

            // set the PDO error mode to exception
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connect;
            
        } catch(PDOException $e) {
            self::$error = $e->getMessage();
            self::error("database");

            echo "Connection failed: " . $e->getMessage();
        }
    }
}

