<?php

class Account extends Database {
    
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

    public function getUser($email)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt;
    }

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
                $_SESSION['username'] = $checkUser['username'];
                $_SESSION['email'] = $checkUser['email'];
                $_SESSION['id'] = $checkUser['id'];
                $_SESSION['rank'] = $checkUser['rank'];
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

}