<?php

if (!empty($_POST['submit']))
{
    if (
        !empty($_POST['host']) &&
        !empty($_POST['host']) &&
        !empty($_POST['username']) && 
        !empty($_POST['password']) &&
        !empty($_POST['database']) &&
        !empty($_POST['title']) &&
        !empty($_POST['header']) &&
        !empty($_POST['acpPassword'])
        ) 
        {
            $install = Application::install(
                $_POST['host'], 
                $_POST['username'], 
                $_POST['password'], 
                $_POST['database'], 
                $_POST['title'], 
                $_POST['header'], 
                $_POST['acpPassword']
            );

            if($install == TRUE)
            {
                // Show error to user
                $message = array(
                    "type" => "success",
                    "text" => "<b>".APP_NAME."</b> was successfully installed. Please rename or delete the install folder."
                );
        
                $_SESSION['message'] = $message;
            }
        } 
        else 
        {
            // Show error to user
            $message = array(
                "type" => "danger",
                "text" => "<b>Error!</b> Please fill in all the values before trying to install."
            );
    
            $_SESSION['message'] = $message;
        }
}

?>