<?php

class Admin extends Database {

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