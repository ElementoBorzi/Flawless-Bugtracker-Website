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
                $_SESSION['rank'] = $getInformation['userRank'];

                header("location: ?page=ucp");
            } 
            else 
            {
                $message = array(
                    "type" => "danger",
                    "text" => "The password is incorrect."
                );

                $_SESSION['message'] = $message;
            } 
        }
        else 
        {
            $message = array(
                "type" => "danger",
                "text" => "The e-mail you inserted is invalid."
            );

            $_SESSION['message'] = $message;
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
            $message = array(
                "type" => "danger",
                "text" => "The entered e-mail is already in use."
            );
            
            $_SESSION['message'] = $message;
        }

        if ($verify["username"] == TRUE)
        {
            $message = array(
                "type" => "danger",
                "text" => "The entered username is already in use."
            );
            
            $_SESSION['message'] = $message;
        } 

        if ($verify["email"] == FALSE && $verify["username"] == FALSE)
        {
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $stmt = $this->connect()->prepare("INSERT INTO ".DATABASE.".users (username, email, password, join_date, userRank) 
            VALUES (:username, :email, :password, :join_date, :userRank)");
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", $encryptedPassword);
            $stmt->bindValue(":join_date", date('Y-m-d'));
            $stmt->bindValue(":userRank", 0);

            $stmt->execute();
            
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