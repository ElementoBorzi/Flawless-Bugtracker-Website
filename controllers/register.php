<?php
    if (!empty($_POST['submit'])) 
    {
        if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordRepeat']) && !empty($_POST['captcha'])) 
        {
            $confirmCaptcha = $Common->verifyCaptcha($_POST['captcha']);

            if ($confirmCaptcha == TRUE)
            {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                $Account->register($username, $email, $password);
            }
            else 
            {
                $message = array(
                    "type" => "danger",
                    "text" => "Incorrect captcha. Please try again."
                );
        
                $_SESSION['message'] = $message;

            }
        } 
        else 
        {
            $message = array(
                "type" => "danger",
                "text" => "In order to login you need to fill in all fields."
            );
    
            $_SESSION['message'] = $message;
        }
    }
    ?>