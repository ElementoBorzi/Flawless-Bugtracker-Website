<?php

if(isset($_POST['login']))
{
    if (!empty($_POST["email"]) && !empty($_POST["password"]))
    {
        Account::login($_POST["email"], $_POST["password"]);
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