<?php

/**
 * This class is used for Admin related functions
 *
 * @name	: Admin.php
 * @package	: Bugtracker
 * @author	: Gabriel Ferreira <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
 */
class Admin extends Database {

    /**
	 * Checks if the inserted password matches the stored password
	 * 
     * @param	: $password (string)
	 * @return	: $_SESSION (string)
	*/
    public function login($password)
    {
        if (ACP_PASSWORD == $password)
        {
            $_SESSION['admin'] = $_SESSION['rank'].$_SESSION['username'];
            header("location: ?page=acp-home"); 
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'>Incorrect Password.</div>";
        }
    }    
}