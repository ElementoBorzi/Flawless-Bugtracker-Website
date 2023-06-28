<?php

class Database {
        
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $database = DATABASE;

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

