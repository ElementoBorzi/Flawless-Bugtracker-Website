<?php

/**
 * This class is used for Database related functions
 *
 * @name	: Database.php
 * @package	: Bugtracker
 * @author	: Gabriel Ferreira <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
 */
class Database {
        
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $database = DATABASE;

    /**
	 * Connect's the system to the database
	 * 
     * @param	: $host (string)
     * @param	: $username (string)
     * @param	: $password (string)
     * @param	: $database (string)
	 * @return	: $connect (string)
	*/
    protected function connect() {
        try {
            $connect = new PDO("mysql:host=".$this->host.";dbname=".$this->database."", $this->username, $this->password);

            // set the PDO error mode to exception
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connect;
            
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}

