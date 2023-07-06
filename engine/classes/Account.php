<?php

/**
 * This class is used for account related functions
 *
 * @name	: Account.php
 * @package	: Bugtracker
 * @author	: Gabriel Ferreira <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
 */
class Account extends Database {

    /**
	 * Checks if a user exists.
	 * 
     * @param	: $userInformation (string)
	 * @return	: $array (array)
	*/
    public function checkUser($userInformation)
    {
        $email = FALSE;
        $userId = FALSE;
        $username = FALSE;

        if (isset($userInformation["email"]))
        {
            $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE email = :email");
            $stmt->bindValue(":email", $userInformation["email"]);
            $stmt->execute();

            if ($stmt->fetch() >= 1)
            {
                $email = TRUE;
            }
        }
        
        if (isset($userInformation["id"]))
        {
            $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE id = :id");
            $stmt->bindValue(":id", $userInformation["id"]);
            $stmt->execute();
            
            if ($stmt->fetch() >= 1)
            {
                $userId = TRUE;
            }
        }
        
        if (isset($userInformation["username"]))
        {
            $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE username = :username");
            $stmt->bindValue(":username", $userInformation["username"]);
            $stmt->execute();
            
            if ($stmt->fetch() >= 1)
            {
                $username = TRUE;
            }
        }

        $array = array(
            "email" => $email, 
            "userId" => $userId, 
            "username" => $username,
            "stmt" => $stmt
        );

        return $array;
    }

    /**
	 * Gets user information based on e-mail.
	 * 
     * @param	: $email (string)
	 * @return	: $stmt (array)
	*/
    public function getUser($email)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt;
    }

    /**
	 * Login system if $email exists and $password match.
	 * 
     * @param	: $email (string)
     * @param	: $password (string)
	 * @return	: $_SESSION['username'] (string)
     * @return	: $_SESSION['email'] (string)
     * @return	: $_SESSION['id'] (string)
     * @return	: $_SESSION['rank'] (string)
	*/
    public function login($email, $password)
    {
        $userInformation = array(
            "email" => $email
        );

        $checkUser = $this->checkUser($userInformation);

        if ($checkUser["email"] == TRUE)
        {
            $getInformation = $this->getUser($email)->fetch();
            
            if (password_verify($password, $getInformation["password"]))
            {
                $_SESSION['username'] = $getInformation['username'];
                $_SESSION['email'] = $getInformation['email'];
                $_SESSION['id'] = $getInformation['id'];
                $_SESSION['rank'] = $getInformation['rank'];
                header("location: ?page=ucp");
            } 
            else 
            {
                echo "<div class='alert alert-danger' role='alert'>The password is incorrect.</div>";
            } 
        }
        else 
        {
            echo "<div class='alert alert-danger' role='alert'>The e-mail you inserted is invalid.</div>";
        }
    }

    /**
	 * Register's a user.
	 * 
     * @param	: $username (string)
     * @param	: $email (string)
     * @param	: $password (string)
	 * @return	: success message.
	*/
    public function register($username, $email, $password)
    {
        $userInformation = array(
            "email" => $email,
            "username" => $username,
            "id" => ""
        );

        $verify = $this->checkUser($userInformation);

        if($verify["email"] == TRUE)
        {
            echo "<div class='alert alert-danger' role='alert'>The entered e-mail is already in use.</div>";
        }

        if ($verify["username"] == TRUE)
        {
            echo "<div class='alert alert-danger' role='alert'>The entered username is already in use.</div>";
        } 

        if ($verify["email"] == FALSE && $verify["username"] == FALSE)
        {
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); 

            $stmt = $this->connect()->prepare("INSERT INTO ".DATABASE.".users (username, email, password, rank) VALUES (:username, :email, :password, :rank)");
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", $encryptedPassword);
            $stmt->bindValue(":rank", "0");

            $stmt->execute();

            echo "<div class='alert alert-success' role='alert'><b>Success!</b> Your account was registered.</div>";
            header ("location: ?page=ucp");
        }
    }

    /**
	 * Get's user total bug reports.
	 * 
     * @param	: $username (string)
	 * @return	: $records (string).
	*/
    public function getAccountTotalBugs($username)
    {
        $stmt = $this->connect()->prepare("SELECT COUNT(*) as allcount FROM ".DATABASE.".bugs WHERE author = :author");
        $stmt->bindValue(":author", $username);
        $stmt->execute();

        $records = $stmt->fetch();

        return $records;
    }
}