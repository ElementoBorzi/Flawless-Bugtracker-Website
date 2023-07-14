<?php

if (!empty($_POST['submit']))
{
    $install = Application::install($_POST['host'], $_POST['username'], $_POST['password'], $_POST['database'], $_POST['title'], $_POST['header'], $_POST['acpPassword']);

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

?>