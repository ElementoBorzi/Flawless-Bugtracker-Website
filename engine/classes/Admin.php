<?php

class Admin extends Database {

    public function getUser($email = "", $id = "")
    {
        if (isset($email))
        {
            $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE email = :email");
            $stmt->bindValue(":email", $email);
        }
        else 
        {
            $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".users WHERE id = :id");
            $stmt->bindValue(":id", $id);
        }

        $stmt->execute();

        return $stmt;
    }

    public function login($email, $password)
    {
        $records = $this->getUser($email)->fetch();

        if (password_verify($password, $records['password']))
        {
            $_SESSION['email'] = $records['email'];
            $_SESSION['id'] = $records['id'];
            header("location: ?page=acp-home");
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'>The password is incorrect.</div>";
        }
    }

    
}