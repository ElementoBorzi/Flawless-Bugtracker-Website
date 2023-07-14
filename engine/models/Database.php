<?php

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
        
    static $host = database["host"];
    static $username = database["username"];
    static $password = database["password"];
    static $database = database["database"];

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

