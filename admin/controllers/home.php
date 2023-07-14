<?php
if(isset($_POST['login']))
{
    if (!empty($_POST['password']))
    {
        Admin::login($_POST['password']);
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